<?php

session_start();

if (isset($_POST['username']) && isset($_POST['password'])){
    $url = "http://api:8888/register?username=" . $_POST['username'] . "&password=" . $_POST['password'];
    $ch = curl_init($url);
    $cookie_file = tempnam("/tmp", "user_cookie");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    curl_setopt($ch, CURLOPT_POST, true);
    $data = curl_exec($ch);
    curl_close($ch);
}

if(isset($_SESSION['id'])){
    header("Location: /index.php");
}

else{
    require '../View/login.php';
}

?>