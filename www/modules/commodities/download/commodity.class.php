<?php

//namespace Modules;

use Modules\MySQLi;

require_once('../../../vendor/autoload.php');
require_once('../../../settings/conf.php');
require_once('../../../settings/connect.php');
require_once('../../../settings/functions.php');
require_once('../../../settings/main.php');


bd_session_start();

// $db = MySQLi::getInstance()->getConnect();

//require_once("../../phpmailer/PHPMailerAutoload.php");

class commodity{


	function getCommodity($limit=null){
		$db = MySQLi::getInstance()->getConnect();
		$arr=array();
		$res=$db->query("SELECT 
				`commodity_ID`,
				`brand_id`,
				`cod`,
				`com_name`,
				a.`alias`,
				`commodity_price`,
				`commodity_price2`,
				`from_url`,
				`cur_id`,
				`com_fulldesc`,
				`com_sizes`,
				`categories_of_commodities_ID`,
				`cat_name`
			FROM `shop_commodity` AS a
			INNER JOIN `shop_categories` AS b
			ON a.`brand_id`=b.`categories_of_commodities_ID`
			WHERE a.`commodity_visible` = 1
			ORDER BY `commodity_ID` ASC");
			// $row=mysql_fetch_assoc($res);

			while($row=$res->fetch_assoc()){
				$arr[$row['commodity_ID']]=array(
					'id'=>$row['commodity_ID'],
					'cat_name'=>$row['cat_name'],
					'art'=>$row['cod'],
					'name'=>$row['com_name'],
					'price'=>$row['commodity_price'],
					'opt'=>$row['commodity_price2'],
					'size'=>$row['com_sizes'],
					'desc'=>$row['com_fulldesc'],
					'from_url'=>$row['from_url'],
					'alias'=>$row['alias'],
				);
			}
		return $arr;
	}

	function getCatName($id){
		$category=array(
			264=>"Одежда Женская",
			265=>"Одежда Детская",
			212=>"Одежда Детская",
			213=>"Одежда Детская",
			209=>"Одежда Мужская",
			261=>"Обувь Женская",
			266=>"Обувь Детская",
			211=>"Обувь Мужская",
			267=>"Аксессуары Женская",
			268=>"Аксессуары Детская",
			210=>"Аксессуары Мужская",
		);
		return $category[$id];
	}
	function getCategoryName($cat){
		$db = MySQLi::getInstance()->getConnect();
		$res=$db->query("SELECT `cat_name` FROM `shop_categories` WHERE `categories_of_commodities_ID`={$cat}");
		$row=$res->fetch_assoc();
		return $row["cat_name"];
	}
	function getPoCategory(){
		$db = MySQLi::getInstance()->getConnect();
		$arr=array();
		$res=$db->query("SELECT 
				b.`categories_of_commodities_parrent`, 
				a.`commodity_ID`,
				b.`cat_name`,
				`cod`,
				`com_name`,
				`com_fulldesc`,
				`com_sizes`,
				`commodity_price`,
				`commodity_price2`,
				a.`alias`,
				a.`brand_id`
				FROM  `shop_commodity` AS a
				INNER JOIN  `shop_categories` AS b ON a.`category_id` = b.`categories_of_commodities_ID` 
				WHERE a.`commodity_visible` =1
				AND b.`categories_of_commodities_parrent` 
				IN ( 264, 213, 212, 209, 261, 266, 211, 267, 268, 210 ) 
				ORDER BY b.`categories_of_commodities_parrent` ASC
				LIMIT 10000
			");

			while($row=$res->fetch_assoc()){
				$arr[$row['commodity_ID']]=array(
					'id'=>$row['commodity_ID'],
					"cat"=>$row["categories_of_commodities_parrent"],
					'cat_name'=>$row['cat_name'],
					'brand'=>$row['brand_id'],
					'art'=>$row['cod'],
					'name'=>$row['com_name'],
					'price'=>$row['commodity_price'],
					'opt'=>$row['commodity_price2'],
					'size'=>$row['com_sizes'],
					'desc'=>$row['com_fulldesc'],
					'from_url'=>$row['from_url'],
					'alias'=>$row['alias'],
				);
			}
		return $arr;

	}

	function getBrenda(){
		
	}

	function getOrders(){
		$db = MySQLi::getInstance()->getConnect();
		$arr=array();

		$res=$db->query("SELECT a.`id` , a.`email` , a.`tel` , a.`name` , a.`status` , a.`date` , b.`offer_id` , b.`count` , b.`price` , b.`com_status` , SUM( b.`price` * b.`count` ) AS summa
			FROM  `shop_orders` AS a
			INNER JOIN  `shop_orders_coms` AS b ON a.`id` = b.`offer_id` 
			WHERE b.`com_status` <>2
			AND  `status` 
			IN ( 1, 2, 3, 4, 5, 6, 7, 8, 12 ) 
			GROUP BY a.`id` ");
		while($row=$res->fetch_assoc()){
			$arr[$row['id']]=array(
				'id'=> $row['id'],
				'date'=> $row['date'],
				'tel'=> $row['tel'],
				'email'=> $row['email'],
				'name'=> $row['name'],
				'summa'=> $row['summa']
			);
		}

		return $arr;
	}
	function getSOCClient(){
		$db = MySQLi::getInstance()->getConnect();
		$arr=array();

		$res=$db->query("SELECT s.`name` AS del_name , a.`id` , a.`city` , a.`email` , a.`tel` , a.`name` , a.`status` , a.`date` , b.`offer_id` , b.`count` , b.`price` , b.`com_status` , SUM( b.`count` ) AS all_count, SUM( b.`price` * b.`count` ) AS summa
			FROM  `shop_delivery` AS s
			INNER JOIN  `shop_orders` AS a ON s.`id` = a.`delivery` 
			INNER JOIN  `shop_orders_coms` AS b ON a.`id` = b.`offer_id` 
			WHERE b.`com_status` NOT IN (2,3)
			AND  `status` IN ( 1, 2, 3, 4, 5, 6, 7, 8, 12 ) 
			GROUP BY a.`id` ");
		while($row=$res->fetch_assoc()){
			$arr[$row['id']]=array(
				'id'=> $row['id'],
				'tel'=> $row['tel'],
				'email'=> $row['email'],
				'name'=> $row['name'],
				'summa'=> $row['summa'],
				'city'=> $row['city'],
				'del_name'=> $row['del_name'],
				'all_count'=> $row['all_count'],
			);
		}

		return $arr;
	}

	function getOrders2($from=null, $to=null){

		$data=null;
		$db = MySQLi::getInstance()->getConnect();
		$arr=array();
		$res=$db->query("SELECT
			a.`id` , 
			a.`city` , 
			a.`email` , 
			a.`tel` , 
			a.`name` , 
			a.`status` , 
			a.`date` , 
			b.`offer_id` , 
			b.`count` , 
			b.`price` , 
			b.`com_status` , 
			SUM( b.`count` ) AS all_count, 
			SUM( b.`price` * b.`count` ) AS summa
			FROM `shop_orders` AS a
			INNER JOIN  `shop_orders_coms` AS b 
			ON a.`id` = b.`offer_id` 
			WHERE b.`com_status` NOT IN (2,3)
			AND  `status` IN ( 1, 2, 3, 4, 5, 6, 7, 8, 12 ) 
			GROUP BY a.`id`
			ORDER BY a.`id`  DESC");
		// $res=$db->query("SELECT
		// 	`id`,
		// 	`city`, 
		// 	`email`, 
		// 	`tel`, 
		// 	`name`, 
		// 	`status`, 
		// 	`date`,
		// 	`address`
		// 	FROM `shop_orders`
		// 	WHERE `status` IN ( 1, 2, 3, 4, 5, 6, 7, 8, 12 )  
		// 	ORDER BY `shop_orders`.`id`  DESC");
		return $res;
	}
	function getOrdersCommodities($id, $from=null, $to=null){

		$data="";
		if($from!=null || $from!=0){
			$data .= " AND supplier2.`date` >= '{$from}'";
		}
		if($to!=null || $to!=0){
			$data .= " AND supplier2.`date` <= '{$to}'";
		}

		$db = MySQLi::getInstance()->getConnect();
		$arr=array();
		$res=$db->query("SELECT 
            a.`id`,
            `com_id`,
            `count`,
            `price`,
            ROUND((`price`/`cur_val`),0) AS price_uan,
            `com`,
            `man_comment`,
            `com_status`,
            a.`group_id`,
            `com_color`,
            `cur_val`,
            `cur_show`,
            cur.`cur_id`,
            `brand_id`,
            `com_name`,
            b.`alias`, 
            `from_url`, 
            cat.`cat_name`,
            b.`cod`,
            client.`status` AS cli_status,
            cattname.`cat_name` AS category_name,
            b.`category_id`,
            cattname.`categories_of_commodities_parrent` AS ccparrent,
            client.`date` AS client_data,
            supplier2.`date` AS supllier_data
            FROM `shop_orders_coms` AS a
            INNER JOIN `shop_commodity` AS b
            ON a.`com_id`=b.`commodity_ID`
            INNER JOIN `shop_cur` AS cur
            ON a.`cur_id`=cur.`cur_id`
            INNER JOIN `shop_categories` AS cat
            ON cat.`categories_of_commodities_ID`=b.`brand_id`
            RIGHT JOIN `shop_orders` AS client
            ON `offer_id`=client.`id`
            RIGHT JOIN `shop_categories` as cattname
            ON  b.`category_id`=cattname.`categories_of_commodities_ID`
            RIGHT JOIN `sup_group` AS supplier2
            ON a.`group_id`=supplier2.`group_id`
            WHERE `offer_id`={$id} {$data}");
		// die("SELECT 
  //           a.`id`,
  //           `com_id`,
  //           `count`,
  //           `price`,
  //           ROUND((`price`/`cur_val`),0) AS price_uan,
  //           `com`,
  //           `man_comment`,
  //           `com_status`,
  //           a.`group_id`,
  //           `com_color`,
  //           `cur_val`,
  //           `cur_show`,
  //           cur.`cur_id`,
  //           `brand_id`,
  //           `com_name`,
  //           b.`alias`, 
  //           `from_url`, 
  //           cat.`cat_name`,
  //           b.`cod`,
  //           client.`status` AS cli_status,
  //           cattname.`cat_name` AS category_name,
  //           b.`category_id`,
  //           cattname.`categories_of_commodities_parrent` AS ccparrent,
  //           client.`date` AS client_data,
  //           supplier2.`date` AS supllier_data
  //           FROM `shop_orders_coms` AS a
  //           INNER JOIN `shop_commodity` AS b
  //           ON a.`com_id`=b.`commodity_ID`
  //           INNER JOIN `shop_cur` AS cur
  //           ON a.`cur_id`=cur.`cur_id`
  //           INNER JOIN `shop_categories` AS cat
  //           ON cat.`categories_of_commodities_ID`=b.`brand_id`
  //           RIGHT JOIN `shop_orders` AS client
  //           ON `offer_id`=client.`id`
  //           RIGHT JOIN `shop_categories` as cattname
  //           ON  b.`category_id`=cattname.`categories_of_commodities_ID`
  //           RIGHT JOIN `sup_group` AS supplier2
  //           ON a.`group_id`=supplier2.`group_id`
  //           WHERE `offer_id`={$id} {$data}");
		return $res;
	}
	function getTrans($cat_name){
		$cat_name=str_replace("упальники","упальник",$cat_name);
				$cat_name=str_replace("офты","офта",$cat_name);
				$cat_name=str_replace("убы","уба",$cat_name);
				$cat_name=str_replace("зы","за",$cat_name);
				$cat_name=str_replace("риджи","риджа",$cat_name);

				$cat_name=str_replace("ие","ой",$cat_name);
				$cat_name=str_replace("ые","ый",$cat_name);
				$cat_name=str_replace("ки","ка",$cat_name);
				$cat_name=str_replace("ы","",$cat_name);
				$cat_name=str_replace("Брюка","Брюки",$cat_name);
		return $cat_name;
	}
	function getCategory($id){
		$category=array(
			264=>"Одежда Ж",
			265=>"Одежда Д",
			212=>"Одежда Д",
			213=>"Одежда Д",
			209=>"Одежда М",
			261=>"Обувь Ж",
			266=>"Обувь Д",
			211=>"Обувь М",
			267=>"Аксессуары Ж",
			268=>"Аксессуары Д",
			210=>"Аксессуары М",
		);

		return $category[$id];
	}

	function getSupplier($id){
		$db = MySQLi::getInstance()->getConnect();
		$arr=array();
		$res=$db->query("SELECT * FROM `brenda_contact` WHERE `com_id`={$id}");

		return $res;
	}

	function getPhoto($id){
		$db = MySQLi::getInstance()->getConnect();
		$arr=array();
		$arr[0]='title';
		$i=1;
		$res=$db->query("SELECT * FROM `shop_images` WHERE `com_id`='{$id}';");
		while ($row=$res->fetch_assoc()) {
			$arr[$i]=$row["img_id"];
			$i++;
		}
		return $arr;
	}

	function getSub(){
		$db = MySQLi::getInstance()->getConnect();
		$arr=array();
		$ii=0;
		$res=$db->query("SELECT `sub_email`,`user_name`,`phone` FROM `subscribe` WHERE 1 LIMIT 60000, 30000");
		while($row=$res->fetch_assoc()){
			$arr[$ii]=array(
				'email'=> $row['sub_email'],
				'name'=> $row['user_name'],
				'tel'=> $row['phone'],
			);
			$ii++;
		}
		return $arr;
	}



 }


?>
