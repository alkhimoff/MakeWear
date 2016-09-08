<?php


namespace Modules;

require_once('../../../vendor/autoload.php');
require_once('../../../settings/conf.php');
require_once('../../../settings/connect.php');
require_once('../../../settings/functions.php');
require_once('../../../settings/main.php');

bd_session_start();

$db = MySQLi::getInstance()->getConnect();

	if($_POST["status"]==1){
		$id=$_POST["id"];
		$name=$_POST["name"];
		$desc=$_POST["desc"];
		$alias=$_POST["alias"];
		$title_seo=$_POST["title_seo"];
		$desc_seo=$_POST["desc_seo"];
		$tags=$_POST["tags"];


		$db->query("UPDATE `articles` 
			SET 
				`name`='{$name}',
				`desc`='{$desc}',
				`tags`='{$tags}',
				`alias`='{$alias}',
				`title_seo`='{$title_seo}',
				`desc_seo`='{$desc_seo}' 
			WHERE `a_id`={$id}
			");
	}
	if($_POST["status"]==2){
		$id=$_POST["id"];
		$name=$_POST["name"];
		$desc=$_POST["desc"];
		$alias=$_POST["alisa"];
		$title_seo=$_POST["title_seo"];
		$desc_seo=$_POST["desc_seo"];
		$tags=$_POST["tags"];


		$db->query("INSERT INTO 
			`articles`(`name`, `desc`, `tags`, `alias`, `title_seo`, `desc_seo`) 
		VALUES ('{$name}', '{$desc}', '{$tags}', '{$alisa}', '{$title_seo}', '{$desc_seo}')
			");

		echo 1;
	}

	if(isset($_POST["selectId"])){
		$id=$_POST["selectId"];
		$arr=array();

		$res=$db->query("SELECT * FROM `articles` WHERE `a_id`='{$id}'; ");
		$row=$res->fetch_assoc();
		$arr=array(
			'name'=>$row["name"],
			'desc'=>$row["desc"],
			'tags'=>$row["tags"],
			'alias'=>$row["alias"],
			'title_seo'=>$row["title_seo"],
			'desc_seo'=>$row["desc_seo"],
			);
		echo json_encode($arr);
	}

	if(isset($_POST["del"])){
		$del=$_POST["del"];
		$db->query("DELETE FROM `articles` WHERE `a_id`='{$del}'; ");
	}

?>
