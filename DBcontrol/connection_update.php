<?php

header('Content-type: application/json');

include_once ("dbsettings.php");

$db = db::getInstance();

$retuen_jason = array(
	"error" =>0,
	"error_message" => '',
	"data" => array(),
);

$id = (isset($_GET["id"])) ? $_GET["id"] : 0;
$University = (isset($_GET["university"])) ? $_GET["university"] : 0;
$City = (isset($_GET["city"])) ? $_GET["city"] : 0;
$Country = (isset($_GET["country"])) ? $_GET["country"] : 0;
$CourseName = (isset($_GET["courseName"])) ? $_GET["courseName"] : 0;
$CourseDescription = (isset($_GET["courseDescription"])) ? $_GET["courseDescription"] : 0;
$StartDate = (isset($_GET["startDate"])) ? $_GET["startDate"] : 0;
$EndDate = (isset($_GET["endDate"])) ? $_GET["endDate"] : 0;
$Price = (isset($_GET["price"])) ? $_GET["price"] : 0;
$Currency = (isset($_GET["currency"])) ? $_GET["currency"] : 0;
$action = (isset($_GET["action"])) ? $_GET["action"] : 0;

$Qupdatedomain= 'no';
$resp = '';

try{
	if($action == "add"){
		$Qupdatedomain = "INSERT INTO table_1 SET COL_1 = '{$University}',COL_2 = '{$City}',COL_3 = '{$Country}',COL_4 = '{$CourseDescription}',COL_5 = '{$StartDate}',COL_6 = '{$EndDate}',COL_7 ={$Price},COL_8 = '{$Currency}'";
		$resp = $db->insert($Qupdatedomain);
		$retuen_jason["data"]["newid"] = $resp;
	}elseif($action == "update"){
		$Qupdatedomain = "UPDATE table_1 SET COL_1 = '{$University}',COL_2 = '{$City}',COL_3 = '{$Country}',COL_4 = '{$CourseDescription}',COL_5 = '{$StartDate}',COL_6 = '{$EndDate}',COL_7 = {$Price},COL_8 = '{$Currency}'";
		$resp = $db->sql($Qupdatedomain);
		$retuen_jason["data"]["effected"] = $resp;
	}elseif($action == "remove"){
		$Qupdatedomain = "DELETE FROM table_1 WHERE id=".$id;
		$resp = $db->sql($Qupdatedomain);	
		$retuen_jason["data"]["deleted"] = $resp;	
	}else{
		$retuen_jason["error_message"] = "no data recived";	
	}

	
}catch(Exception $e){
	$retuen_jason["error"] = 1;
	$retuen_jason["error_message"] = $e->getMessage();
}


echo json_encode($retuen_jason);
exit;






?>