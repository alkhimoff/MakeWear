<?php

include "commodity.class.php";

// $sub=commodity::getSub();

// foreach ($sub as $key => $value) {
// 	echo $key.": {$value['email']},{$value['name']},{$value['tel']} <br/>";
// }

$exc = new PHPExcel();
	$exc->setActiveSheetIndex(0);
	$exc2=$exc->getActiveSheet();
	$ii=1;

	$a=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","S","T","U","V","W","X");	
	$tab=array("Email","Ф.И.О","Телефон");	
	for($i=0; $i<count($a); $i++){
		$exc2->getColumnDimension($a[$i])->setAutoSize(true);
	}

	for($i=0; $i<count($tab); $i++){
		$exc2->SetCellValue($a[$i].$ii, $tab[$i]);
		$exc2->getStyle($a[$i].$ii)->getFont()->setBold(true);
	}
	$ii=2;

	$sub=commodity::getSub();
	foreach ($sub as $k => $v) {
		$exc2->SetCellValue('A'.$ii, $v['email']);
		$exc2->SetCellValue('B'.$ii, $v['name']);
		$exc2->SetCellValue('C'.$ii, $v['tel']);
		$ii++;
	}

	$today = date("d/m/Y"); 
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="subscribe.xls"');
	header('Cache-Control: max-age=0');
	
	$writer = PHPExcel_IOFactory::createWriter($exc, 'Excel5');
	$writer->save('php://output');