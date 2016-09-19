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
    var_dump($cookie_list);
    echo("<br />");
    curl_close($ch);
    #$allobj = json_decode($json);
    var_dump($data);
    #set cookie on user's side
    #var_dump($allobj);
    echo("<br><br>extraction finished");
}

else{
    require '../View/login.php';
}

?>