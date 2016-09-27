<?php
/* Nick Thomas and Andrew Stoddard
University of Utah
cs4000 - Capstone
4/17/2016
CSynapse
*/

require '../Model/hidden/api.php';
require '../Controller/api_request_functions.php';

if(isset($_POST['name'])){
	create($_POST['name']);
	header("Location: index.php");

	$url = $api_url . "/data";
	make_api_post_file_request($url, $_POST, "upload", "upload");

	$url = $api_url . "/test?name=" . $_POST['name'];

	$algorithms = $_POST['algorithm'];

	foreach($algorithms as $algorithm){
		$url = $url . "&algorithm=" . $algorithm;
	}
	echo($url);
	make_api_post_request($url);

	header("Location: /index.php");
}

require '../View/head.php';
require '../View/nav.php';
require '../View/forms.php';
?>