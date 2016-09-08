<?php

namespace Modules;

require_once('../../../vendor/autoload.php');
require_once('../../../settings/conf.php');
require_once('../../../settings/connect.php');
require_once('../../../settings/functions.php');
require_once('../../../settings/main.php');

bd_session_start();

$db = MySQLi::getInstance()->getConnect();

	if(isset($_GET['idd'])){
		$id=$_GET['idd'];
		// $sql=mysql_query("SELECT * 
		// 		FROM  `shop_orders` AS a
		// 		INNER JOIN `shop_orders_coms` AS b 
		// 		ON a.`id`=b.`offer_id`
		// 		WHERE b.`offer_id`='{$id}'; ");

		$sql=$db->query("SELECT * 
				FROM  `shop_orders` AS a
				INNER JOIN `shop_orders_coms` AS b 
				ON a.`id`=b.`offer_id`
				WHERE b.`offer_id`='{$id}';");
		// while($row=mysql_fetch_assoc($sql)){
		while($row=$sql->fetch_assoc()){
			
		}
		echo "idd: ".$id;
	}
	if(isset($_GET["cat"])){
		$cat=$_GET["cat"];
		$arr=array();
		// $sqq=mysql_query("SELECT * FROM `brenda_contact` WHERE `com_id`='{$cat}'; ");
		$sqq=$db->query("SELECT * FROM `brenda_contact` WHERE `com_id`='{$cat}';");

		// while($r=mysql_fetch_assoc($sqq)){
		while($r=$sqq->fetch_assoc()){
			$arr=array(
				"con_flp"=>$r["con_flp"],
				"con_egp"=>$r["con_egp"],
				"con_inn"=>$r["con_inn"],
				"con_add"=>$r["con_add"],
				"con_pc"=>$r["con_pc"],
				"con_bank"=>$r["con_bank"],
				"con_mfo"=>$r["con_mfo"]
			);
		}
		echo json_encode($arr);
	}
?>