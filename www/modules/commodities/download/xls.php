<?php

// require_once "../../../includes/phpexcel/Classes/PHPExcel.php";
// require_once "../../../includes/phpexcel/Classes/PHPExcel/Writer/Excel2007.php";

include "commodity.class.php";


	$exc = new PHPExcel();
	$exc->setActiveSheetIndex(0);
	$exc2=$exc->getActiveSheet();
	$ii=1;

	$a=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","S","T","U","V","W","X");	
	$tab=array("ID","Артикул","Категория","Название","Розница","Опт","Размер","Описание","Ссылка на товар","Источник","Фото");	
	for($i=0; $i<count($a); $i++){
		$exc2->getColumnDimension($a[$i])->setAutoSize(true);
	}

	for($i=0; $i<count($tab); $i++){
		$exc2->SetCellValue($a[$i].$ii, $tab[$i]);
		$exc2->getStyle($a[$i].$ii)->getFont()->setBold(true);
	}
	$ii=2;

	$shop=commodity::getCommodity();
	foreach ($shop as $k => $v) {
		$exc2->getRowDimension($ii)->setRowHeight(150);
		$exc2->SetCellValue('A'.$ii, $v['id']);
		$exc2->SetCellValue('B'.$ii, $v['art']);
		$exc2->SetCellValue('C'.$ii, $v['cat_name']);
		$exc2->SetCellValue('D'.$ii, $v['name']);
		$exc2->SetCellValue('E'.$ii, $v['price']);
		$exc2->SetCellValue('F'.$ii, $v['opt']);
		$exc2->SetCellValue('G'.$ii, $v['size']);
		$exc2->SetCellValue('H'.$ii, $v['desc']);
		$exc2->SetCellValue('I'.$ii, "http://makewear.com.ua/product/{$v['id']}/{$v['alias']}.html");
		$exc2->SetCellValue('J'.$ii, $v['from_url']);


		$img=commodity::getPhoto($v['id']);
		$putImg='';
		$bb=array("K","L","M","N","O","P","Q","R","S","S","T","U","V","W","X");
		$bii=0;
		for($i=0; $i<count($img); $i++){
				$putImg.="http://makewear-images.azureedge.net/{$v['id']}/{$img[$i]}.jpg\n";
				$bii++;
		}
		$exc2->SetCellValue('K'.$ii, $putImg);

		$ii++;
	}

	$today = date("d/m/Y"); 
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="commodities'.$today.'.xls"');
	header('Cache-Control: max-age=0');
	
	$writer = PHPExcel_IOFactory::createWriter($exc, 'Excel5');
	$writer->save('php://output');


?>
