<?php

session_start();

if(isset($_SESSION['id'])){
    unset($_SESSION['id']);
    unset($_SESSION['user']);
    unset($_SESSION['active']);
    session_destroy();
}

header("Location: login.php");

?>