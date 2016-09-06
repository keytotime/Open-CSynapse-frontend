<?php
/* Nick Thomas and Andrew Stoddard
University of Utah
cs4000 - Capstone
4/17/2016
CSynapse
*/

require '../Model/csynapse.php';

session_start();

$_SESSION['active'] = '';


$table = '';

$url = "https://csynapse.com/app/all";
$json = file_get_contents($url);
$allobj = json_decode($json);
$training = 0;

$position = 0;
foreach($allobj->{'ids'} as $id){
    $csynapse = new CSynapse($id);
    $status = "Ready";
    $position = $position + 1;
    if($csynapse->completion < 1){
        $status = "Training";
        $training = $training + 1;
    }
    else{
        $_SESSION['active'] = $_SESSION['active'] . "<li><a href='/Controller/results.php?id=" . $id . "'>" . $csynapse->name . "</a></li>";
    }
    $table = $table . "<tr>
                <td>" . $position . "</td>
                <td><a href=\"/Controller/results.php?id=" . $id . "\">" . $csynapse->name . "</a></td>
                <td>" . $status . "</td>
                <td>" . $csynapse->type . "</td>
                <td>" . $csynapse->size . "</td>
            </tr>";
}

$active = $position - $training; 

require '../View/head.php';
require '../View/nav.php';
require '../View/index.php';
?>