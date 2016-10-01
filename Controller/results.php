<?php
/* Nick Thomas and Andrew Stoddard
University of Utah
cs4000 - Capstone
4/17/2016
CSynapse
*/

require '../Model/csynapse.php';
require '../Model/hidden/api.php';
require '../Controller/api_request_functions.php';

if(!logged_in()){
    header("Location: login.php");
    die();
    return;
}

$csynapse = $_GET['id'];

$url = $api_url . "/getPoints?name=" . $csynapse;
$json = make_api_get_request($url);


$scatterdata = '[{';

if(!empty($allobj)){
    $allobj = json_decode($json);
    $allobj = $allobj->{'3'};
    foreach($allobj as $key => $value){
        $scatterdata = $scatterdata . "name: '" . $key . "', data: " . json_encode($value) . "},{";
    }
}

if(strlen($scatterdata) > 2){
    $scatterdata = substr($scatterdata, 0, -2);
}
else{
    $scatterdata = '[{name: "Unplottable", data:[]}';
}
$scatterdata = $scatterdata .']';



$url = $api_url . "/testResults?name=" . $csynapse;
$json = make_api_get_request($url);


$accuracydata = '[{';
$speeddata = '[{';
$datatable = '';
if(!empty($allobj)){
    $allobj = json_decode($json);
    $allobj = $allobj->{'testResults'};
    foreach($allobj as $algo){
        $accuracydata = $accuracydata . "name: '" . $algo->{"description"} . "', data: [" . $algo->{"score"}*100 . "]},{";
        $speeddata = $speeddata . "name: '" . $algo->{"description"} . "', data: [" . $algo->{"time"} . "]},{";
        $datatable = $datatable . "<tr><td>" . $algo->{"description"} . "</td><td>" . round($algo->{"score"}*100,2) . "%</td><td>". round($algo->{"time"},3) ."s</td></tr>";

    }
}


if(strlen($speeddata) > 2){
    $speeddata = substr($speeddata, 0, -2);
}
else{
    $speeddata = '[';
}
$speeddata = $speeddata .']';

if(strlen($accuracydata) > 2){
    $accuracydata = substr($accuracydata, 0, -2);
}
else{
    $accuracydata = '[';
}
$accuracydata = $accuracydata .']';


require '../View/head.php';
require '../View/nav.php';
require '../View/results.php';

?>