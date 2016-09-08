<?php
namespace Modules;

require_once('../vendor/autoload.php');
require_once('../settings/conf.php');
require_once('../settings/connect.php');
require_once('../settings/functions.php');
require_once('../settings/main.php');

bd_session_start();

$db = MySQLi::getInstance()->getConnect();

	$xml=simplexml_load_file("https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5");
	for($i=0; $i<count($xml->row); $i++){
		$curname=$xml->row[$i]->exchangerate['ccy'];
		if($curname=="RUR") $curname="RUB";
		$buy=$xml->row[$i]->exchangerate['buy'];
		$sale=$xml->row[$i]->exchangerate['sale'];
		
		$a=1/floatval($sale);
		
		$db->query("UPDATE `shop_cur` SET cur_val='{$a}' WHERE cur_name='{$curname}'");		
					
	}	

?>