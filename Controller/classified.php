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

$mongoId = urldecode($_GET['id']);
$name = urldecode($_GET['name']);

$url = $api_url . "/getClassified?mongoId=" . $mongoId;
$json = make_api_get_request($url);
$allobj = json_decode($json);
$allobj = $allobj->{'classified_data'};

$table = '';

$columns=0;

$lines = explode("\n", $allobj);



foreach ($lines as $line){

    $items = explode(",", $line);
    if ( count($items) > 1){
        $columns = count($items);
        $table = $table . "<tr>";
        foreach ($items as $item){
            $table = $table . "<td>" . $item . "</td>";
        }
        $table = $table . "</tr>";
    }
}

$table_header = $table_header . '<tr><th>Classification</th>';

for ($i = 1; $i < $columns; $i++){
    $table_header = $table_header . "<th>Feature" . $i . "</th>";
}

$table_header = $table_header . '</tr>';

require '../View/head.php';
require '../View/nav.php';
require '../View/classified.php';

?>