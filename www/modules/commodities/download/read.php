<?php

use Modules\MySQLi;

require_once('../../../vendor/autoload.php');
require_once('../../../settings/conf.php');
require_once('../../../settings/connect.php');
require_once('../../../settings/functions.php');
require_once('../../../settings/main.php');
require_once "../../../includes/phpexcel/Classes/PHPExcel.php";

bd_session_start();

$db = MySQLi::getInstance()->getConnect();


$ar=readExelFile("max.xls");
$flag=1;
$name="";
$i=0;
foreach($ar as $ar_colls){

	$read1=$ar_colls[1];
	$read2=$ar_colls[2];
	$read3=$ar_colls[3];


	// if($read2!=""){


		// if(strpos($read3,"@")!==false){
		// 	$res=$db->query("SELECT * FROM `subscribe` WHERE `sub_email` LIKE '{$read3}'; ");
		// 	$num=$res->num_rows;
		// 	if($num == 0){
		// 		$db->query("INSERT INTO `subscribe` (`sub_email`, `sub_type`, `user_name`, `phone`) 
		// 									VALUES ('{$read3}','29', '{$read1}', '{$read2}') ");
		// 	}
		// 	echo $read1.", ".$read2.", ".$read3."<br/>";
		// }
		
		// echo $read." - {$num} ok<br/>";user_name,phone

		// if($flag==1){
		// 	$name=$read2;
		// 	$flag=2;
		// }elseif($flag==2){
		// 	if(strpos($read2,"@")!==false){
		// 		$res=$db->query("SELECT * FROM `subscribe` WHERE `sub_email` LIKE '{$read2}'; ");
		// 		$num=$res->num_rows;
		// 		if($num == 0){
		// 			$db->query("INSERT INTO `subscribe` (`sub_email`, `sub_type`, `user_name`, `phone`) 
		// 										VALUES ('{$read2}','29', '{$name}', '{$read1}') ");
		// 		}
		// 		echo $read1.", ".$read2.", ".$name."<br/>";
		// 		$flag=1;
		// 	}
		// }

		// if($i%3==2){
		// 	$name=$read1;
		// }elseif($i%3==0){
		// 	if(strpos($read2,"@")!==false){
		// 		$res=$db->query("SELECT * FROM `subscribe` WHERE `sub_email` LIKE '{$read2}'; ");
		// 		$num=$res->num_rows;
		// 		if($num == 0){
		// 			$db->query("INSERT INTO `subscribe` (`sub_email`, `sub_type`, `user_name`, `phone`) 
		// 										VALUES ('{$read2}','29', '{$name}', '{$read1}') ");
		// 		}
		// 		echo $read1.", ".$read2.", ".$name."<br/>";

		// 	}
		// }
	// }
	$i++;
}


function readExelFile($filepath){
// require_once «PHPExcel.php»; //подключаем наш фреймворк
	$ar=array(); // инициализируем массив
	$inputFileType = PHPExcel_IOFactory::identify($filepath);  // узнаем тип файла, excel может хранить файлы в разных форматах, xls, xlsx и другие
	$objReader = PHPExcel_IOFactory::createReader($inputFileType); // создаем объект для чтения файла
	$objPHPExcel = $objReader->load($filepath); // загружаем данные файла в объект
	$ar = $objPHPExcel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив
	return $ar; //возвращаем массив
}

?>
