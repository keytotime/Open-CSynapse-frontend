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

$num_classified = 0;
$table = '';
$_SESSION['active'] = '';
$position = 0;
$username = json_decode(make_api_get_request($api_url."/getUsername"))->{'username'};

$url = $api_url . "/csynapses";
$json = make_api_get_request($url);
$allobj = json_decode($json);

$notification = '';
$_SESSION['notifications'] = '';

if(!empty($allobj->{'csynapses'})){
    
    foreach($allobj->{'csynapses'} as $name){
        $_SESSION['active'] = $_SESSION['active'] . "<li><a href='/Controller/results.php?id=" . $name . "'>" . $name . "</a></li>";
        $type = "Vector";
        $size = "X";
        $status = "Ready";
        $position = $position + 1;
        $table = $table . "<tr>
                    <!--<td>" . $position . "</td>-->
                    <td><a href=\"/Controller/results.php?id=" . $name . "\">" . $name . "</a></td>
                    <td>" . $status . "</td>
                    <!--<td>" . $type . "</td>-->
                    <!--<td>" . $size . "</td>-->
                </tr>";
    }
}

$url = $api_url . "/getAllAvailableClassified";
$json = make_api_get_request($url);
$allobj = json_decode($json);
$allobj = $allobj->{'all_classified'};

// $notifications = array();

// if(!empty($allobj)){
//     foreach($allobj as $csynapse){
//         if(!empty($csynapse)){
//             foreach($csynapse as $Classified){
//                 if(!array_key_exists($Classified->{'datasetName'} , $notifications)){
//                     $notifications[$Classified->{'datasetName'}]['mongoId'] = $Classified->{'mongoId'};
//                     $notifications[$Classified->{'datasetName'}]['timeStamp'] = time();
//                 }
//             }
//         }
//     }
// }

// var_dump($notifications);

// usort($notifications, function($a, $b) {
//     return $a['timeStamp'] <=> $b['timeStamp'];
// });

// var_dump($notifications);

// if(!empty($allobj)){
//     foreach($notifications as $noti){
//                 $notification .= '<a href="#" class="list-group-item">
//                     <i class="glyphicon glyphicoftablen-ok"></i> Classification of '. key($noti) .' has completed. 
//                     <span class="pull-right text-muted small"><em>' . $noti['timeStamp'] . '</em></span></a>';
//                 $nav_notification .= '<li><a href="#"><div>
//                     <i class="glyphicon glyphicon-ok"></i> Dataset Completed
//                     <span class="pull-right text-muted small">Now</span>';
//     }
// }

foreach($allobj as $csynapse){
    foreach($csynapse as $item){     
        foreach($item as $Classified){
            $num_classified += 1;
            $notification .= '<a href="download.php?id=' . $Classified->{'mongoId'} . '&name=' . $Classified->{'datasetName'} . '&ext=csv" class="list-group-item">
                <i class="glyphicon glyphicon-ok"></i> Classification of '. $Classified->{'datasetName'} .' has completed. 
                <span class="pull-right text-muted small"><em>Now</em></span></a>';
            $_SESSION['notifications'] .= '<li><a href="download.php?id=' . $Classified->{'mongoId'} . '&name=' . $Classified->{'datasetName'} . '&ext=csv"><div>
                <i class="glyphicon glyphicon-ok"></i> ' . $Classified->{'datasetName'} . ' Completed
                <span class="pull-right text-muted small">Now</span>
                </div></a></li><li class="divider"></li>';
        }        
    }
}


require '../View/head.php';
require '../View/nav.php';
require '../View/index.php';
?>