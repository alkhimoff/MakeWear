<?php
	
namespace Modules;

require_once('../../../vendor/autoload.php');
require_once('../../../settings/conf.php');
require_once('../../../settings/connect.php');
require_once('../../../settings/functions.php');
require_once('../../../settings/main.php');

bd_session_start();

$db = MySQLi::getInstance()->getConnect();
	
	if(isset($_POST["rel"])){
		$rel=$_POST["rel"];
		$name=$_POST["name"];
		$email=$_POST["email"];
		$check=$_POST["check"];
		$comment=$_POST["comment"];
		$today = date("Y-m-d H:i:s"); 

		$db->query("INSERT INTO 
			`articles_comment`(`articles_id`, `ac_name`, `ac_email`, `ac_comment`, `checkbox`, `date`) 
			VALUES ('{$rel}','{$name}','{$email}','{$comment}','{$check}', '{$today}')
			");

		echo $today;
	}

?>