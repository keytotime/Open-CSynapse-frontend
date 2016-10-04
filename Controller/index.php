<?php
/* Nick Thomas and Andrew Stoddard
University of Utah
cs4000 - Capstone
4/17/2016
CSynapse
*/

require '../Model/hidden/api.php';
require '../Controller/api_request_functions.php';


if(!logged_in()){
    header("Location: login.php");
    die();
    return;
}

$table = '';
$_SESSION['active'] = '';
$position = 0;

$url = $api_url . "/csynapses";
$json = make_api_get_request($url);
$allobj = json_decode($json);



if(!empty($allobj->{'csynapses'})){
    
    foreach($allobj->{'csynapses'} as $name){
        $_SESSION['active'] = $_SESSION['active'] . "<li><a href='/Controller/results.php?id=" . $name . "'>" . $name . "</a></li>";
        $type = "Vector";
        $size = "X";
        $status = "Ready";
        $position = $position + 1;
        $table = $table . "<tr>
                    <td>" . $position . "</td>
                    <td><a href=\"/Controller/results.php?id=" . $name . "\">" . $name . "</a></td>
                    <td>" . $status . "</td>
                    <td>" . $type . "</td>
                    <td>" . $size . "</td>
                </tr>";
    }
}

require '../View/head.php';
require '../View/nav.php';
require '../View/index.php';
?>