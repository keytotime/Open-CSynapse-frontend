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
}

$gets='';
if(isset($_GET['name']) && isset($_GET['algorithm'])){
	$gets = "?name=";
	$gets .= $_GET['name'];
	$gets .= "&algorithm=";
	$gets .= $_GET['algorithm'];
}
else{
	header("Location: login.php");
}


//If name is given, add data to CSynapse.
if(isset($_POST['name'])){
	$url = $api_url . "/run";
	$_POST['dataName'] = $_POST['name'];
	$_POST['name']= $_GET['name'];
	$_POST['algorithm'] = $_GET['algorithm'];
	make_api_post_file_request($url, $_POST, "upload", "upload");

	header("Location: /index.php");
}


require '../View/head.php';
require '../View/nav.php';
require '../View/classify.php';
?>