<?php

if (isset($_POST['username']) && isset($_POST['password'])){
    echo("variables set<br><br>");
    $url = "http://api:8888/login?username=" . $_POST['username'] . "&password=" . $_POST['password'];
    $ch = curl_init($url);
    $cookie_file = tempnam("/tmp", "user_cookie");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    curl_setopt($ch, CURLOPT_POST, true);
    $data = curl_exec($ch);
    $cookie_list = curl_getinfo($ch, CURLINFO_COOKIELIST);
    $regex = "^(?<domain>.*?)\t(?<flag>.*?)\t(?<path>.*?)\t(?<secure>.*?)\t(?<expiration>.*?)\t(?<name>.*?)\t(?<value>.*?)$";
    $cookie = preg_split($regex,$str,-1,PREG_SPLIT_DELIM_CAPTURE);
    session_start();
    echo("<br />");
    echo($cookie("value"));
    echo("<br />");
    curl_close($ch);
    #$allobj = json_decode($json);
    #set cookie on user's side
    #var_dump($allobj);
    echo("<br><br>extraction finished");
}

else{
    require '../View/login.php';
}

?>