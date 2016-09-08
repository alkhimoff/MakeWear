<?php

require_once "../../../includes/phpexcel/Classes/PHPExcel.php";
require_once "../../../includes/phpexcel/Classes/PHPExcel/Writer/Excel2007.php";
include "commodity.class.php";


	$cat=commodity::getPoCategory();

	$exc = new PHPExcel();
	$exc->setActiveSheetIndex(0);
	$exc2=$exc->getActiveSheet();
	$a=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","S","T","U","V","W","X");
	for($i=0; $i<count($a); $i++){
		$exc2->getColumnDimension($a[$i])->setAutoSize(true);
	}
	$ii=1;

	foreach ($cat as $key => $val) {
		if(!$push[$val['cat']]){
			$push[$val['cat']]=1;
			$catName=commodity::getCatName($val['cat']);
			// echo "<h2>{$catName}</h2><br/><br/>";
			$exc2->SetCellValue('A'.$ii, $catName);
			$exc2->getStyle('A'.$ii)->getFont()->setBold(true);
			$ii+=2;
			$tab=array("ID","Бренд","Артикул", "Название", "Описание", "Розница", "Опт", "Ссылка", "Фото");	
			for($i=0; $i<count($tab); $i++){
				$exc2->SetCellValue($a[$i].$ii, $tab[$i]);
				$exc2->getStyle($a[$i].$ii)->getFont()->setBold(true);
			}
			
			$ii++;
		}
		$img=commodity::getPhoto($val['id']);
		
		$desc=strip_tags($val['desc']);

		$exc2->SetCellValue('A'.$ii, $val['id']);
		$catt=commodity::getCategoryName($val['brand']);
		$exc2->SetCellValue('B'.$ii, $catt);
		$exc2->SetCellValue('C'.$ii, $val['art']);
		$exc2->SetCellValue('D'.$ii, $val['name']);
		$exc2->SetCellValue('E'.$ii, $desc);
		$exc2->SetCellValue('F'.$ii, $val['price']);
		$exc2->SetCellValue('G'.$ii, $val['opt']);
		$exc2->SetCellValue('H'.$ii, "http://makewear.com.ua/product/{$val['art']}/{$val['alias']}.html");

		$putImg='';
		for($j=0; $j<count($img); $j++){
			$putImg.="http://makewear-images.azureedge.net/{$v['id']}/{$img[$j]}.jpg\n";
		}
		$exc2->SetCellValue('I'.$ii, $putImg);

		$exc2->getRowDimension($ii)->setRowHeight(50);

		$ii++;
	}


	$today = date("d/m/Y"); 
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="po-category'.$today.'.xls"');
	header('Cache-Control: max-age=0');
	
	$writer = PHPExcel_IOFactory::createWriter($exc, 'Excel5');
	$writer->save('php://output');

?>