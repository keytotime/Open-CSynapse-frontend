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
$alg_id = $_GET['algo'];

$url = $api_url . "/testResults?name=" . $csynapse;
$json = make_api_get_request($url);
$allobj = json_decode($json);
if(!empty($allobj->{'testResults'})){
  $allobj = $allobj->{'testResults'};
  // var_dump($allobj);
  foreach($allobj as $algo){
    if(strcmp($algo->{"id"}, $alg_id) == 0)
    {
      echo str_replace("\n", "<br />", str_replace(" ", "&nbsp;", $algo->{"error_text"}));
    }
  }
}

?>