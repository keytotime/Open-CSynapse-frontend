<?php

require '../Model/hidden/api.php';
require '../Controller/api_request_functions.php';

session_start();

$message = '';

if (isset($_POST['username']) && isset($_POST['password'])){
    if(!login($_POST['username'],$_POST['password'])){
    	$message = '<font color= #ff0000>*Username/Password incorrect. Please try again.</font>';
    }

}

if(logged_in()){
    header("Location: index.php");
}

else{
    require '../View/login.php';
}

?>