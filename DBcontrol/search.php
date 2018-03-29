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

$search = (isset($_GET["search"]))? $_GET["search"] : '';
$page = (isset($_GET["page"]) && is_int($_GET["page"]))? $_GET["page"] : 1;
$type = (isset($_GET["type"])) ? 1: 0;
$pageE = $page * 10;
$pageS = $pageE - 9;
	
$Qupdatedomain= 'no';
$resp = '';

try{
	if($type > 0){
		$Qupdatedomain = "SELECT id FROM table_1";
	} else{
		$Qupdatedomain = "SELECT id, COL_4 AS Course, concat(COL_2,' ',COL_3,' ',COL_1) AS Location,COL_6 AS startDate,COL_7 AS endDate, concat(COL_8,' ',COL_9) AS Price from table_1 where COL_4 LIKE '{$search}_%' LIMIT {$pageS},{$pageE}";
	}
	
	$resp = $db->getAll($Qupdatedomain);
	echo json_encode($resp);
}catch(Exception $e){
	$retuen_jason["error"] = 1;
	$retuen_jason["error_message"] = $e->getMessage();
	echo '<html><body><div>'.json_encode($retuen_jason).'<div></body></html>';	
}
?>