<?php
/* Nick Thomas and Andrew Stoddard
University of Utah
cs4000 - Capstone
4/17/2016
CSynapse
*/

require '../Model/hidden/api.php';
require '../Controller/api_request_functions.php';

$mongoId = urldecode($_GET['id']);
$data = urldecode($_GET['name']);
$extension = urldecode($_GET['ext']);
$filename = $data . '.' . $extension;

$url = $api_url . "/getClassified?mongoId=" . $mongoId;
$json = make_api_get_request($url, true, $filename);


?>