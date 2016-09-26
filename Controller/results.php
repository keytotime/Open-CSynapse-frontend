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

$csynapse = $_GET['id'];

$url = $api_url . "/testResults?user=sam&name=" . $csynapse;
$json = make_api_get_request($url);
$allobj = json_decode($json);

// var_dump($allobj);


// $scatterdata = '[{';

// foreach($csynapse->graphdata as $key => $value){
//     $scatterdata = $scatterdata . "name: '" . $key . "', data: " . json_encode($value) . "},{";
// }

// if(strlen($scatterdata) > 2){
//     $scatterdata = substr($scatterdata, 0, -2);
// }
// else{
//     $scatterdata = '[{name: "Unplottable", data:[]}';
// }
// $scatterdata = $scatterdata .']';

// $accuracydata = '[{';
// $speeddata = '[{';

$accuracydata = '[{';
$speeddata = '[{';
$datatable = '';

foreach($allobj as $algo){
    $accuracydata = $accuracydata . "name: '" . $algo->{"algoId"} . "', data: [" . $algo->{"score"}*100 . "]},{";
    $speeddata = $speeddata . "name: '" . $algo->{"algoId"} . "', data: [" . $algo->{"time"} . "]},{";
    $datatable = $datatable . "<tr><td>" . $algo->{"algoId"} . "</td><td>" . round($algo->{"score"},2) . "%</td><td>". round($algo->{"time"},5) ."s</td></tr>";

}

echo($speeddata);


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


$url = $api_url . "/testResults?user=sam&name=" . $csynapse;
$json = make_api_get_request($url);
$allobj = json_decode($json);
$allobj = json_decode($allobj[0]->{1});

echo($allobj[0]->{"2"});

$scatterdata = $allobj;

//$scatterdata = "[{name: '" $allobj[0]->{1}[0] "' data: " . $allobj[0]->{1}[1] . "]";


require '../View/head.php';
require '../View/nav.php';
require '../View/results.php';

?>