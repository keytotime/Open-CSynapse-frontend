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

$csynapse = $_GET['id'];


if(isset($_GET['plot'])){
    $plot = $_GET['plot'];
}
else{
    $plot = "2d";
}

if($plot == "2d"){
    $plotdisplay = '<script src="../js/scatter2d.js"></script>';
}
else if($plot == "3d"){
    $plotdisplay = '<script src="../js/scatter3d.js"></script>';
}

$url = $api_url . "/getPoints?name=" . $csynapse;
$json = make_api_get_request($url);
$scatterdata = '';
$headerPoints = json_encode('');
$labels = json_encode('');

if(!strpos($json,"Error: 500 Internal Server Error")){
    $jsonDecoded = json_decode($json);
    $allobj = $jsonDecoded ->{'points'};

    $scatterdata = '[{';

    if(!empty($allobj->{'3'})){

        $allobj = $allobj->{'3'};
        foreach($allobj as $key => $value){
            $scatterdata = $scatterdata . "name: '" . $key . "', data: " . json_encode($value) . "},{";
        }
    }

    if(strlen($scatterdata) > 2){
        $scatterdata = substr($scatterdata, 0, -2);
    }
    else{
        $scatterdata = '[{name: "Not Available", data:[]}';
    }
    $scatterdata = $scatterdata .']';


    if(isset($jsonDecoded ->{'headerPoints'})){
        $headerPoints = json_encode($jsonDecoded ->{'headerPoints'});
        $labels = json_encode($jsonDecoded ->{'labels'});
    }
}







$url = $api_url . "/testResults?name=" . $csynapse;
$json = make_api_get_request($url);
$allobj = json_decode($json);

$accuracydata = '[{';
$speeddata = '[{';
$datatable = '';
$processing = false;
if(!empty($allobj->{'testResults'})){
    
    $allobj = $allobj->{'testResults'};
    foreach($allobj as $algo){
        $datatable = $datatable . "<tr id='".$algo->{"id"}."_row'>";
        if (strcmp($algo->{"status"}, "complete") == 0) {
            $accuracydata = $accuracydata . "name: '" . $algo->{"description"} . "', data: [" . $algo->{"score"}*100 . "]},{";
            $speeddata = $speeddata . "name: '" . $algo->{"description"} . "', data: [" . $algo->{"time"} . "]},{";
            $datatable = $datatable . "<td><a href='classify.php?name=" . urlencode($csynapse) . "&algorithm=" . $algo->{"id"} ."'>" .  $algo->{"description"} . "</a></td><td><span id='".$algo->{"id"}."_accuracy'>" . round($algo->{"score"}*100,2) . "</span>%</td><td><span id='".$algo->{"id"}."_time'>". round($algo->{"time"},3) ."</span>s</td>";
        }
        elseif (strcmp($algo->{"status"}, "processing") == 0) {
            $datatable = $datatable . "<td><a href='classify.php?name=" . urlencode($csynapse) . "&algorithm=" . $algo->{"id"} ."'>" .  $algo->{"description"} . "</a></td><td><span id='".$algo->{"id"}."_accuracy'>--</span></td><td><span id='".$algo->{"id"}."_time'>Processing</span></td>";
            $processing = true;
        }
        else
        {
            $datatable = $datatable . "<td><a href='classify.php?name=" . urlencode($csynapse) . "&algorithm=" . $algo->{"id"} ."'>" .  $algo->{"description"} . "</a></td><td><span id='".$algo->{"id"}."_accuracy'>--</span></td><td><span id='".$algo->{"id"}."_time'>ERROR</span></td>";
        }
        $datatable = $datatable . "</tr>";

    }
}

$datatable = $datatable . "</tbody></table>";

if ($processing) {
    $datatable = $datatable . "The page may need to be refreshed to see updated values<br />";
}

$datatable = $datatable . "<a href='add.php?csynapse=" . urlencode($csynapse) . "'>Add more algorithms...</a>";


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

// Get regression Data
$url = $api_url . "/regressionData?limit=10&name=" . $csynapse;
$json = make_api_get_request($url);
$regJson = json_decode($json); 
$regressionData = json_encode('');
$regressionList = '';
if(strcmp($regJson->{'status'},'error') !== 0) {

    $regressionList = '<div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    10 Strongest Correlations
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body"><table width="100%" class="table table-striped table-bordered table-hover" id="datatable"><tr><th>Correlation</th><th>R</th><th>R-Squared</th><th>P</th></tr>';
                                    
    $lastPart = '</table></div>
                    <!-- /.panel-body -->
                    </div>
                        <!-- /.panel -->
                    </div>';

    $regList = $regJson->{'regressionData'};
    $regressionData = json_encode($regList);
    foreach($regList as $regData){
        $result = '<tr><td>' . $regData->{'h1'}  . ' and ' . $regData->{'h2'} . '</td><td>'.round($regData->{'r'}, 2) . '</td><td>' . round($regData->{'rSquared'},2) . '</td><td>'.round($regData->{'p'},2).'</td></tr>';
        $regressionList = $regressionList . $result;
    }
    $regressionList = $regressionList . $lastPart;
}
require '../View/head.php';
require '../View/nav.php';
require '../View/results.php';

?>