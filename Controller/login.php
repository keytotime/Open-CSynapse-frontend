<?php

require '../Model/hidden/api.php';
require '../Controller/api_request_functions.php';

session_start();

if (isset($_POST['username']) && isset($_POST['password'])){
    login($_POST['username'],$_POST['password']);

}

if(logged_in()){
    header("Location: index.php");
}

else{
    require '../View/login.php';
}

?>