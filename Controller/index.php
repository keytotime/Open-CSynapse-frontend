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
$position = 0;
$username = json_decode(make_api_get_request($api_url."/getUsername"))->{'username'};

$url = $api_url . "/csynapses";
$json = make_api_get_request($url);
$allobj = json_decode($json);



if(!empty($allobj->{'csynapses'})){
    
    foreach($allobj->{'csynapses'} as $name){
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

$url = $api_url . "/getAllAvailableClassified";
$json = make_api_get_request($url);
$allobj = json_decode($json);
$allobj = $allobj->{'all_classified'};

$notification = '';

foreach($allobj as $csynapse){
    foreach($csynapse as $item){     
        foreach($item as $Classified){
            $num_classified += 1;
            $notification .= '<a href="classified.php?id=' . $Classified->{'mongoId'} . '&name=' . $Classified->{'datasetName'} . '" class="list-group-item">
                <i class="glyphicon glyphicon-ok"></i> Classification of '. $Classified->{'datasetName'} .' has completed. 
                <span class="pull-right text-muted small"><em>View</em></span></a>';
        }        
    }
}

if($notification == ''){
    $notification = '
                <i class="glyphicon glyphicon-info-sign"></i> You don\'t have any classifications yet. 
                <span class="pull-right text-muted small"></span></a>';
}

require '../View/head.php';
require '../View/nav.php';
require '../View/index.php';
?>