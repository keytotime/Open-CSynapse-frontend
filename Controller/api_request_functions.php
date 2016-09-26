<?php
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
    return $data;
}
function make_api_get_request($url)
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
    return $data;
}
?>