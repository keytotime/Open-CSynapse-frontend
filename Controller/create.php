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


//If name is given, add algorithms requested to CSynapse.
if(isset($_POST['name'])){
	// If upload data is given, create new CSynapse with it. 
	create($_POST['name']);

	$url = $api_url . "/data";
	make_api_post_file_request($url, $_POST, "upload", "upload");

	$url = $api_url . "/test?name=" . $_POST['name'];

	$algorithms = $_POST['algorithm'];

	foreach($algorithms as $algorithm){
		$url = $url . "&algorithm={\"algorithm\":\"" . $algorithm . "\"}";
	}
	make_api_post_request($url);

	header("Location: /index.php");

}

$url = $api_url . "/algorithms";
$json = make_api_get_request($url);
$allobj = json_decode($json);
$allobj = $allobj->{'algorithms'};

$params = "";
$style = "<style>
.row{
    margin-top:0px;
    padding: 0 10px;
}

.clickable{
    cursor: pointer;   
}

.panel-heading span {
	margin-top: -20px;
	font-size: 15px;
}";
$dropdown = '<select id="algorithm">';

foreach($allobj as $algo){
	if($algo->{'type'} == 'supervised'){
		$dropdown = $dropdown . '<option value="' . $algo->{'algoId'} . '">' . $algo->{'name'} . '</option>';
		$style = $style . '

		.' . $algo->{'algoId'} . ' {
			display:none;
		}';
	    $params = $params . '<div class="' . $algo->{'algoId'} . '">';
	    $params = $params . '    <div class="row">
					<div class="col-lg-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">' . $algo->{'name'} . '</h3>
								<span class="pull-right clickable panel-collapsed">';
								if(!empty($algo->{'paramInfo'})){
									$params = $params . '<i class="glyphicon glyphicon-chevron-up"></i>';
								}

								$params = $params . '</span>
							</div>
							<div class="panel-body" style="display: none"><input type="hidden" name="algorithm[]" value="' . $algo->{'algoId'} . '">';
		foreach($algo->{'paramInfo'} as $param){
			$params = $params .  $param->{'name'} . ': ';
			if($param->{'type'} == "set"){

				$params = $params .  '<div class="form-group"> <select span="3">';
				foreach($param->{'values'} as $value){
					$params = $params . '<option value="' . $value . '">' . $value . '</option>';
				}
				$params = $params .  '<select></div>';
			}
			if($param->{'type'} == "int" || $param->{'type'} == "float"){
				
				$params = $params . '<div class="form-group"> <input type="number"';
				$params = $params . ' value = "' . $param->{'default'} . '"';
				$params = $params . ' min = "' . $param->{'greater'} . '"';
				if($param->{'lessOrEqual'} != 'none'){
					$params = $params . ' max = "' . $param->{'lessOrEqual'} . '"';
				}
				$params = $params . ' name = "' . $param->{'name'} . '[]" required></div>';
				
			}
			$params = $params;
			
		}
		$params = $params . '</div>
						</div>
					</div>
				</div>
			</div>';
	}
}

$dropdown = $dropdown . '</select>';
$style = $style . "</style>";

require '../View/head.php';
require '../View/nav.php';
require '../View/create.php';

?>