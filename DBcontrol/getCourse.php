<?php
error_reporting(E_ALL);
ini_set('display_errors','On');

header('Content-type: application/json');

include_once ("dbsettings.php");

$db = db::getInstance();

$retuen_jason = array(
	"error" =>0,
	"error_message" => '',
	"data" => array(),
);

$id = (isset($_GET["id"]))? $_GET["id"] : 0;
$Qupdatedomain= 'no';
$resp = '';

try{
	if($id > 0){
		$Qupdatedomain = "SELECT * FROM table_1 WHERE id={$id}";
		$resp = $db->getAll($Qupdatedomain);
		echo json_encode($resp);
	} else{
		$retuen_jason["error_message"] = "no data recived";	
	}
}catch(Exception $e){
	$retuen_jason["error"] = 1;
	$retuen_jason["error_message"] = $e->getMessage();
	echo '<html><body><div>'.json_encode($retuen_jason).'<div></body></html>';	
}
?>