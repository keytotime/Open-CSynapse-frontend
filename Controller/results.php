<?php
/* Nick Thomas and Andrew Stoddard
University of Utah
cs4000 - Capstone
4/17/2016
CSynapse
*/

require '../Model/csynapse.php';

$csynapse = new CSynapse($_GET['id']);

$scatterdata = '[{';

foreach($csynapse->graphdata as $key => $value){
    $scatterdata = $scatterdata . "name: '" . $key . "', data: " . json_encode($value) . "},{";
}

if(strlen($scatterdata) > 2){
    $scatterdata = substr($scatterdata, 0, -2);
}
else{
    $scatterdata = '[{name: "Unplottable", data:[]}';
}
$scatterdata = $scatterdata .']';

$accuracydata = '[{';
$speeddata = '[{';
$datatable = '';

foreach($csynapse->algorithms as $algo){
    if($algo->status == 1){
        $accuracydata = $accuracydata . "name: '" . $algo->name . "', data: [" . $algo->data->{'score'}*100 . "]},{";
        $speeddata = $speeddata . "name: '" . $algo->name . "', data: [" . $algo->data->{'time'} . "]},{";
        $datatable = $datatable . "<tr><td>" . $algo->name . "</td><td>" . round($algo->data->{'score'}*100,2) . "%</td><td>" . round($algo->data->{'time'},5) . " Seconds</td></tr>";
    }
    else{
        $datatable = $datatable . "<tr><td>" . $algo->name . "</td><td>X</td><td>Not Yet Finished</td></tr>";
    }

}

if(strlen($speeddata) > 2){
    $speeddata = substr($speeddata, 0, -2);
}
else{
    $scatterdata = '[';
}
$speeddata = $speeddata .']';

if(strlen($accuracydata) > 2){
    $accuracydata = substr($accuracydata, 0, -2);
}
else{
    $scatterdata = '[';
}
$accuracydata = $accuracydata .']';

require '../View/head.php';
require '../View/nav.php';
require '../View/results.php';

?>