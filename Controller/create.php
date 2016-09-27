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
}

require '../View/head.php';
require '../View/nav.php';
require '../View/forms.php';
?>