<?php

require '../Model/hidden/api.php';
require '../Controller/api_request_functions.php';

session_start();

if (isset($_POST['username']) && isset($_POST['password'])){
    login($_POST['username'],$_POST['password']);

}

if(isset($_SESSION['id'])){
    header("Location: /index.php");
}

else{
    require '../View/login.php';
}

?>