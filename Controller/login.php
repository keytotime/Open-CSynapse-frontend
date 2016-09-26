<?php

require '../Model/hidden/api.php';
require '../Controller/api_request_functions.php';

session_start();

if (isset($_POST['username']) && isset($_POST['password'])){
    $url = $api_url . "/login?username=" . $_POST['username'] . "&password=" . $_POST['password'];
    $json = make_api_post_request($url);
    $_SESSION['user'] = $_POST['username'];
    echo($_SESSION['id']);
    echo($_SESSION['user']);
}

if(isset($_SESSION['id'])){
    header("Location: /index.php");
}

else{
    require '../View/login.php';
}

?>