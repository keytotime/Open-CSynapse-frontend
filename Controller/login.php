<?php

session_start();

if (isset($_POST['username']) && isset($_POST['password'])){
    $url = "http://api:8888/login?username=" . $_POST['username'] . "&password=" . $_POST['password'];
    $ch = curl_init($url);
    $cookie_file = tempnam("/tmp", "user_cookie");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    curl_setopt($ch, CURLOPT_POST, true);
    $data = curl_exec($ch);
    $cookie_list = curl_getinfo($ch, CURLINFO_COOKIELIST);
    $matches = explode(' ', $cookie_list[0]);
    $matches = explode("\t", $matches[0]);
    $_SESSION['id'] = $matches[6];
    curl_close($ch);
}

if(isset($_SESSION['id'])){
    header("Location: /index.php");
}

else{
    require '../View/login.php';
}

?>