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


if(isset($_GET['csynapse'])){
	$csynapse = $_GET['csynapse'];
}



//If name is given, add algorithms requested to CSynapse.
if(isset($_POST['algorithm'])){
	echo($_POST['algorithm']);

	$url = $api_url . "/test?name=" . $csynapse;

	$algorithms = $_POST['algorithm'];

	foreach($algorithms as $algorithm){
		$url = $url . "&algorithm=" . $algorithm;
	}
	make_api_post_request($url);

	header("Location: results.php?id=" . $csynapse);
}

$url = $api_url . "/algorithms";
$json = make_api_get_request($url);
$allobj = json_decode($json);
$allobj = $allobj->{'algorithms'};

$buttons = "";

foreach($allobj as $algo){
	if($algo->{'type'} == 'supervised'){
	    $buttons = $buttons . '<label class="btn btn-primary btn-lg col-lg-4 col-md-6 col-sm-12">
	    <input type="checkbox" name="algorithm[]" value="' . $algo->{'algoId'} . '"> ' . $algo->{'name'} . '
	    </label>';
	}
}

require '../View/head.php';
require '../View/nav.php';
require '../View/add.php';

?>