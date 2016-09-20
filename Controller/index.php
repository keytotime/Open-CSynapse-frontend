<?php
/* Nick Thomas and Andrew Stoddard
University of Utah
cs4000 - Capstone
4/17/2016
CSynapse
*/

require '../Model/csynapse.php';
require '../Model/hidden/api.php';

session_start();

echo($_SESSION['id']);
echo($_SESSION['user']);

$table = '';

$url = $api_url . "/csynapses?user=Nick";

$opts = array('https' => array('header'=> 'Cookie: beaker.session.id=' . $_SESSION['id']."\r\n"));
$context = stream_context_create($opts);
$contents = file_get_contents($url, false, $context);

$json = file_get_contents($url);
$allobj = json_decode($json);

// $training = 0;

$position = 0;
foreach($allobj->{'csynapses'} as $name){
    //$csynapse = new CSynapse($id);
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

// $active = $position - $training; 

require '../View/head.php';
require '../View/nav.php';
require '../View/index.php';
?>