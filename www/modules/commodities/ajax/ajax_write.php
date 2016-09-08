<?php

namespace Modules;

require_once('../../../vendor/autoload.php');
require_once('../../../settings/conf.php');
require_once('../../../settings/connect.php');
require_once('../../../settings/functions.php');
require_once('../../../settings/main.php');

bd_session_start();

$db = MySQLi::getInstance()->getConnect();
	
	if(isset($_POST['rel'])){ 
		$id=$_POST['rel'];
		$txt=$_POST['txt'];
		$wr=$_POST['wr_name'];

		if(strpos($id,"_")!==false){
			$so=explode("_", $id);
			
			$db->query(<<<QUERY1
        	UPDATE `shop_order_supplier` SET `{$wr}`='{$txt}' WHERE `order_id`='{$so[0]}' AND `supplier_name_id`='{$so[1]}';
QUERY1
    );
		}else{

			$db->query(<<<QUERY1
        	UPDATE `sup_group` SET `{$wr}`='{$txt}' WHERE `group_id`='{$id}';
QUERY1
    );
		}
	}

	if(isset($_POST['rel_id'])){
		$id=$_POST['rel_id'];
		$txt=$_POST['txt'];
		$wr=$_POST['rel_db_tab'];

		$db->query(<<<QUERY1
        UPDATE `sup_group` SET `{$wr}`='{$txt}' WHERE `group_id`='{$id}';
QUERY1
    );
	}
	if(isset($_POST['rel_id2'])){
		$id=$_POST['rel_id2'];
		$txt=$_POST['txt'];
		$wr=$_POST['rel_db_tab'];

		$db->query(<<<QUERY1
        UPDATE `shop_orders` SET `{$wr}`='{$txt}' WHERE `id`='{$id}';
QUERY1
    );
	}

?>