<?php

function return_file($data, $filename)
{
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
    // var_dump($data);
    curl_close($ch);
    unlink($cookie_file);
    // echo($data);
    return $data;
}

function make_api_get_request($url, $return_file = false, $filename="")
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $cookie_text = $_SESSION['id'][0];
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
    // var_dump($data);
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
    $ch = curl_init($url);
    $cookie_file = tempnam("/tmp", "user_cookie");
    $cookie_file_d = fopen($cookie_file, "w") or die("Unable to open temporary cookie file!");
    fwrite($cookie_file_d, $cookie_text);
    fclose($cookie_file_d);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_opts);
    // var_dump($post_opts);
    $data = curl_exec($ch);
    $cookie_list = curl_getinfo($ch, CURLINFO_COOKIELIST);
    $_SESSION['id'] = $cookie_list;
    // var_dump($data);
    curl_close($ch);
    unlink($cookie_file);
    return $data;
}

function make_api_post_file_request($url, $post_opts, $file_opt, $filename)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $cookie_text = $_SESSION['id'][0];
    $ch = curl_init($url);
    $cookie_file = tempnam("/tmp", "user_cookie");
    $cookie_file_d = fopen($cookie_file, "w") or die("Unable to open temporary cookie file!");
    fwrite($cookie_file_d, $cookie_text);
    fclose($cookie_file_d);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
    curl_setopt($ch, CURLOPT_POST, true);
    $post_opts[$file_opt] = new CurlFile($_FILES[$filename]["tmp_name"], "text/plain", "upload");#'@'.realpath($_FILES[$filename]["tmp_name"]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_opts);
    // var_dump($post_opts);
    $data = curl_exec($ch);
    $cookie_list = curl_getinfo($ch, CURLINFO_COOKIELIST);
    $_SESSION['id'] = $cookie_list;
    // var_dump($data);
    curl_close($ch);
    unlink($cookie_file);
    return $data;
}

function login($username,$password){
    require '../Model/hidden/api.php';

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $api_url = "https://csynapse.com/api";
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
    
    $url = $api_url . "/create?name=" . $name;
    $json = make_api_post_request($url);
}

function logged_in(){
    $loggedin = false;
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['id'])){
        $loggedin = true;
    }
    return $loggedin;
}

?>