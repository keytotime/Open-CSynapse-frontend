<?php

session_start();

if(isset($_SESSION['id'])){
    unset($_SESSION['id']);
    unset($_SESSION['user']);
}

header("Location: login.php");

?>