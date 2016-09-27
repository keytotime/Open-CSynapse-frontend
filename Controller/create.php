<?php
/* Nick Thomas and Andrew Stoddard
University of Utah
cs4000 - Capstone
4/17/2016
CSynapse
*/

require '../Model/hidden/api.php';
require '../Controller/api_request_functions.php';

if(isset($_POST['description'])){
	create($_POST['description']);
	header("Location: index.php");
}

require '../View/head.php';
require '../View/nav.php';
require '../View/forms.php';
?>