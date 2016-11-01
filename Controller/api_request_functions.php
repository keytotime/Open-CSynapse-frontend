<?php

function return_file($data, $filename)
{
    $data = json_decode($data);
    $data = $data->{'classified_data'};
    $tmp_file = tempnam("/tmp", "tmp_download");
    $tmp_file_d = fopen($tmp_file, "w") or die("Unable to open temporary download file!");
    fwrite($tmp_file_d, $data);
    fclose($tmp_file_d);
    
    if (file_exists($tmp_file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($tmp_file));
        readfile($tmp_file);
        unlink($tmp_file);
        exit();
    }
}

function make_api_post_request($url)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $cookie_text = $_SESSION['id'][0];
    $url = str_replace(" ", "%20", $url);
    $ch = curl_init($url);
    $cookie_file = tempnam("/tmp", "user_cookie");
    $cookie_file_d = fopen($cookie_file, "w") or die("Unable to open temporary cookie file!");
    fwrite($cookie_file_d, $cookie_text);
    fclose($cookie_file_d);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
    curl_setopt($ch, CURLOPT_POST, true);
    $data = curl_exec($ch);
    $cookie_list = curl_getinfo($ch, CURLINFO_COOKIELIST);
    $_SESSION['id'] = $cookie_list;
    curl_close($ch);
    unlink($cookie_file);
    return $data;
}

function make_api_get_request($url, $return_file = false, $filename="")
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $cookie_text = $_SESSION['id'][0];
    $url = str_replace(" ", "%20", $url);
    $ch = curl_init($url);
    $cookie_file = tempnam("/tmp", "user_cookie");
    $cookie_file_d = fopen($cookie_file, "w") or die("Unable to open temporary cookie file!");
    fwrite($cookie_file_d, $cookie_text);
    fclose($cookie_file_d);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
    $data = curl_exec($ch);
    $cookie_list = curl_getinfo($ch, CURLINFO_COOKIELIST);
    $_SESSION['id'] = $cookie_list;
    curl_close($ch);
    unlink($cookie_file);
    if ($return_file)
    {
        return_file($data, $filename);
    }
    else
    {
        return $data;
    }
}

function make_api_post_array_request($url, $post_opts)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $cookie_text = $_SESSION['id'][0];
    #$url = str_replace(" ", "%20", $url);
    $ch = curl_init($url);
    $cookie_file = tempnam("/tmp", "user_cookie");
    $cookie_file_d = fopen($cookie_file, "w") or die("Unable to open temporary cookie file!");
    fwrite($cookie_file_d, $cookie_text);
    fclose($cookie_file_d);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt_custom_postfields($ch, $post_opts);
    $data = curl_exec($ch);
    $cookie_list = curl_getinfo($ch, CURLINFO_COOKIELIST);
    $_SESSION['id'] = $cookie_list;
    curl_close($ch);
    unlink($cookie_file);
    return $data;
}

#used from https://gist.github.com/simensen/288242 does not have a license stated.
#builds the multipart http request where CURLFile cannot do it natively.
#DO NOT MESS WITH THIS FUNCTION.
function curl_setopt_custom_postfields($ch, $postfields, $headers = null) {
    $algos = hash_algos();
    $hashAlgo = null;
    foreach ( array('sha1', 'md5') as $preferred ) {
        if ( in_array($preferred, $algos) ) {
            $hashAlgo = $preferred;
            break;
        }
    }
    if ( $hashAlgo === null ) { list($hashAlgo) = $algos; }
    $boundary =
        '----------------------------' .
        substr(hash($hashAlgo, 'cURL-php-multiple-value-same-key-support' . microtime()), 0, 12);

    $body = array();
    $crlf = "\r\n";
    $fields = array();
    foreach ( $postfields as $key => $value ) {
        if ( is_array($value) ) {
            foreach ( $value as $v ) {
                $fields[] = array($key, $v);
            }
        } else {
            $fields[] = array($key, $value);
        }
    }
    foreach ( $fields as $field ) {
        list($key, $value) = $field;
        if ( strpos($value, '@') === 0 ) {
            preg_match('/^@(.*?)$/', $value, $matches);
            list($dummy, $filename) = $matches;
            $body[] = '--' . $boundary;
            $body[] = 'Content-Disposition: form-data; name="' . $key . '"; filename="' . basename($filename) . '"';
            $body[] = 'Content-Type: application/octet-stream';
            $body[] = '';
            $body[] = file_get_contents($filename);
        } else {
            $body[] = '--' . $boundary;
            $body[] = 'Content-Disposition: form-data; name="' . $key . '"';
            $body[] = '';
            $body[] = $value;
        }
    }
    $body[] = '--' . $boundary . '--';
    $body[] = '';
    $contentType = 'multipart/form-data; boundary=' . $boundary;
    $content = join($crlf, $body);
    $contentLength = strlen($content);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Length: ' . $contentLength,
        'Expect: 100-continue',
        'Content-Type: ' . $contentType,
    ));

    curl_setopt($ch, CURLOPT_POSTFIELDS, $content);

}

function make_api_post_file_request($url, $post_opts, $api_file_opt, $original_file_opt)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $cookie_text = $_SESSION['id'][0];
    #$url = str_replace(" ", "%20", $url);
    $ch = curl_init($url);
    $cookie_file = tempnam("/tmp", "user_cookie");
    $cookie_file_d = fopen($cookie_file, "w") or die("Unable to open temporary cookie file!");
    fwrite($cookie_file_d, $cookie_text);
    fclose($cookie_file_d);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
    curl_setopt($ch, CURLOPT_POST, true);
    $post_opts[$api_file_opt] = [];
    $file_num = 0;
    foreach($_FILES[$original_file_opt]["tmp_name"] as $tmp_name)
    {
        array_push($post_opts[$api_file_opt], '@'.realpath($tmp_name));
    }
    foreach($_FILES[$original_file_opt]["name"] as $name)
    {
        #echo "Checking ". $name."<br />";
        $check_match = preg_match("/.*?\.zip$/i", $name);
        var_dump($check_match);
        if ($check_match == 1)
        {
            $post_opts["zipped"] = "true";
        }
    }
    var_dump($post_opts);
    curl_setopt_custom_postfields($ch, $post_opts);
    $data = curl_exec($ch);
    $cookie_list = curl_getinfo($ch, CURLINFO_COOKIELIST);
    $_SESSION['id'] = $cookie_list;
    curl_close($ch);
    unlink($cookie_file);
    return $data;
}

function login($username,$password){
    require '../Model/hidden/api.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $url = $api_url . "/login?username=" . $username . "&password=" . $password;
    $json = make_api_post_request($url);
    $_SESSION['user'] = $username;
}

function register($username,$password){
    require '../Model/hidden/api.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $url = $api_url . "/register?username=" . $username . "&password=" . $password;
    $json = make_api_post_request($url);
    login($username,$password);
}

function create($name){
    require '../Model/hidden/api.php';
    
    $url = $api_url . "/create";
    $_POST['name'] = $name;
    $json = make_api_post_array_request($url, $_POST);
}

function logged_in(){
    require '../Model/hidden/api.php';
    $loggedin = false;
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['id'])){
        $request = make_api_get_request($api_url."/getUsername");
        $usernameResponse = json_decode($request);
        if ($usernameResponse->{'status'} == "ok")
        {
            $loggedin = true;
        }
        else
        {
            session_destroy();
            session_start();
        }
    }
    return $loggedin;
}

?>