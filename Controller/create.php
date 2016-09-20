<?php
/* Nick Thomas and Andrew Stoddard
University of Utah
cs4000 - Capstone
4/17/2016
CSynapse
*/

require '../Model/hidden/api.php';

if(isset($_POST['description'])){
	$url = "http://" . $api_url . "/create?user=sam&name=" . $_POST['description'];
	$json = file_get_contents($url);
	$allobj = json_decode($json);

	var_dump($allobj);

}

require '../View/head.php';
require '../View/nav.php';
require '../View/forms.php';
?>