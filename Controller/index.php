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

session_start();

echo($_SESSION['id'][0]);
echo($_SESSION['user']);

$table = '';

$url = $api_url . "/csynapses";

$json = make_api_get_request($url);
$allobj = json_decode($json);
var_dump($result);

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