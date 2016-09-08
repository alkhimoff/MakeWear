<?php

require_once "../../../includes/phpexcel/Classes/PHPExcel.php";
require_once "../../../includes/phpexcel/Classes/PHPExcel/Writer/Excel2007.php";
include "commodity.class.php";


	$order=commodity::getSOCClient();

	$exc = new PHPExcel();
	$exc->setActiveSheetIndex(0);
	$exc2=$exc->getActiveSheet();
	$ii=1;

	$a=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","S","T","U","V","W","X");	
	$tab=array("ID","Ф.И.О","Email", "Телефон", "Город","Доставка","Кол-во", "Cумма");	
	for($i=0; $i<count($a); $i++){
		$exc2->getColumnDimension($a[$i])->setAutoSize(true);
	}

	for($i=0; $i<count($tab); $i++){
		$exc2->SetCellValue($a[$i].$ii, $tab[$i]);
		$exc2->getStyle($a[$i].$ii)->getFont()->setBold(true);
	}
	$ii=2;

	foreach ($order as $k => $v) {
		// echo $v['id'].", ".$v['name'].", ".$v["email"].", ".$v['tel'].", ".$v['city'].", ".$v['del_name'].", ".$v['all_count'].", ".$v['summa']."<br/>";
		$exc2->SetCellValue('A'.$ii, $v['id']);
		$exc2->SetCellValue('B'.$ii, $v['name']);
		$exc2->SetCellValue('C'.$ii, $v['email']);
		$exc2->SetCellValue('D'.$ii, $v['tel']);
		$exc2->SetCellValue('E'.$ii, $v['city']);
		$exc2->SetCellValue('F'.$ii, $v['del_name']);
		$exc2->SetCellValue('G'.$ii, $v['all_count']);
		$exc2->SetCellValue('H'.$ii, $v['summa']);
		$ii++;
	}


	$today = date("d/m/Y"); 
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="socclient'.$today.'.xls"');
	header('Cache-Control: max-age=0');
	
	$writer = PHPExcel_IOFactory::createWriter($exc, 'Excel5');
	$writer->save('php://output');

?>