<?php

if (isset($_POST['username']) && isset($_POST['password'])){
    echo("variables set");
    $url = "api:8888/login?username=" . $_POST['username'] . "&password=" . $_POST['password'];
    $json = file_get_contents($url);
    $allobj = json_decode($json);
    var_dump($json);
    var_dump($allobj);
    echo("\n\nextraction finished");
}

else{
    require '../View/login.php';
}

?>