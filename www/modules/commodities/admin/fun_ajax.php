<?php
ini_set("max_execution_time", "99999");
set_time_limit(99999);
error_reporting(E_ALL^E_NOTICE);
require_once("../../../settings/conf.php");
require_once("../../../settings/connect.php");

	if(isset($_GET['down_edit_id'])){
		$id=$_GET['down_edit_id'];
		$site=$_GET['down_site'];
		$cont=$_GET['down_contact'];
		$pay=$_GET['down_payment'];
		$deli=$_GET['down_delivery'];
		
		$cont=str_replace("\n","<br/>",$cont);		
		
		$ss=mysql_query("SELECT * FROM `shop_orders_contact` WHERE `com_id`={$id}");
		$soc=mysql_fetch_assoc($ss);		
		
		if($soc){
			mysql_query("UPDATE `shop_orders_contact` SET `site`='{$site}',`contact`='{$cont}',`payment`='{$pay}',`delivery`='{$deli}' WHERE `com_id`={$id} ");
		}else{
			mysql_query("INSERT INTO `shop_orders_contact` (`com_id`,`site`,`contact`,`payment`,`delivery`) VALUES ('{$id}','{$site}','{$cont}','{$pay}','{$deli}'); ");
		}
		echo "work222";
	}

	if(isset($_GET['down_edit_id2'])){
		$id=$_GET['down_edit_id2'];
		$cont=$_GET['down_contact'];
		$pay=$_GET['down_payment'];
		$deli=$_GET['down_delivery'];
		
		$cont=str_replace("\n","<br/>",$cont);		
		
		$ss=mysql_query("SELECT * FROM `shop_orders_contact` WHERE `com_id`={$id}");
		$soc=mysql_fetch_assoc($ss);		
		
		if($soc){
			mysql_query("UPDATE `shop_orders_contact` SET `contact`='{$cont}',`payment`='{$pay}',`delivery`='{$deli}' WHERE `com_id`={$id} ");
		}else{
			mysql_query("INSERT INTO `shop_orders_contact` (`com_id`,`contact`,`payment`,`delivery`) VALUES ('{$id}','{$cont}','{$pay}','{$deli}'); ");
		}
		echo "work";
	}

	if(isset($_GET['json'])){
		$arr=array();
		$i=0;
		$js=mysql_query("SELECT * FROM `shop_orders_contact`");
		while($jj=mysql_fetch_assoc($js)){
			$id=$jj['com_id'];
			$site=$jj['site'];			
			$cont=$jj['contact'];
			$pay=$jj['payment'];
			$deli=$jj['delivery'];
			
			$arr[$i]=array("comid"=>$id, "site"=>$site, "cont"=>$cont, "pay"=>$pay, "deli"=>$deli);
			$i++;
		}
		echo json_encode($arr);	
		//echo "json work";	
	}

?>