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

$url = $api_url . "/getAllAvailableClassified";
$json = make_api_get_request($url);
$allobj = json_decode($json);
$allobj = $allobj->{'all_classified'};

$table = '';

foreach($allobj as $csynapse){
    foreach($csynapse as $csynapsename => $item){     
        foreach($item as $Classified){
            $name = $Classified->{'datasetName'};
            $algorithm = "SVM";
            $download = '<a href="download.php?id=' . $Classified->{'mongoId'} . '&name=' . $name . '&ext=csv"><i class="fa fa-file-excel-o"></i></a>&nbsp;&nbsp;&nbsp;<a href="download.php?id=' . $Classified->{'mongoId'} . '&name=' . $name . '&ext=txt"><i class="fa fa-file-text-o"></i></a>';
            $delete = '<a href="delete.php?id="###"><i class="fa fa-trash"></i></a>';
            $table = $table . "<tr>
                        <td>" . $name . "</td>
                        <td>" . $csynapsename . "</td>
                        <!--<td>" . $algorithm . "</td>-->
                        <td>" . $download . "</td>
                        <!--<td>" . $delete . "</td>-->
                        </tr>";
        }
    }
}

require '../View/head.php';
require '../View/nav.php';
require '../View/classifications.php';
?>