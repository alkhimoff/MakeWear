<?php

// require_once "../../../includes/phpexcel/Classes/PHPExcel.php";
// require_once "../../../includes/phpexcel/Classes/PHPExcel/Writer/Excel2007.php";

include "commodity.class.php";
	
	$exc = new PHPExcel();
	$exc->setActiveSheetIndex(0);
	$exc2=$exc->getActiveSheet();

	// $orders=commodity::getOrders2();
	// foreach($orders as $v){
	// 	echo "<b>".$v["id"].", ".$v["name"].", ".$v["email"].", ".$v["city"].", ".$v["address"].", ".$v["date"]."</b><br/>";
	// 	$comm=commodity::getOrdersCommodities($v["id"]);
	// 	foreach ($comm as $kj => $vj) {
	// 		echo $vj["cat_name"].", ".$vj["cod"].", ".$vj["category_name"].", ".$vj["com_name"].", ".$vj["com_color"].", ".$vj["com"].", ".$vj["count"].", ".$vj["price"].", ".($vj["price"]*$vj["count"]).", ".$vj["price"].", http://makewear.com.ua/product/{$vj['commodity_ID']}/{$vj['alias']}.html, ".$vj["from_url"]."<br/>";
	// 	}
	// }


	// var_dump($orders->num_rows);
	$ii=1;

	$a=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","S","T","U","V","W","X");	
	// $tab=array($v['id'],$v['name'],$v['email'],$v['city'],$v['address'],$v['date']);	
	for($i=0; $i<count($a); $i++){
		$exc2->getColumnDimension($a[$i])->setAutoSize(true);
	}

	// for($i=0; $i<count($tab); $i++){
	// 	$exc2->SetCellValue($a[$i].$ii, $tab[$i]);
	// 	$exc2->getStyle($a[$i].$ii)->getFont()->setBold(true);
	// }
	// $ii=2;

	$shop=commodity::getOrders2();
	foreach ($shop as $k => $v) {
		// $exc2->getRowDimension($ii)->setRowHeight(150);
		$exc2->SetCellValue('A'.$ii, $v['id'])->getStyle('A'.$ii)->getFont()->setBold(true);
		$exc2->SetCellValue('B'.$ii, $v['name'])->getStyle('B'.$ii)->getFont()->setBold(true);
		$exc2->SetCellValue('C'.$ii, $v['email'])->getStyle('C'.$ii)->getFont()->setBold(true);
		$exc2->SetCellValue('D'.$ii, $v['city'])->getStyle('D'.$ii)->getFont()->setBold(true);
		$exc2->SetCellValue('E'.$ii, $v['address'])->getStyle('E'.$ii)->getFont()->setBold(true);
		$exc2->SetCellValue('F'.$ii, $v['date'])->getStyle('F'.$ii)->getFont()->setBold(true);
		
		$ii++;

		$tab=array("Бренд","Артикул","Товар","Название","Цвет","Размер","Кол-во","Цена","Сумма","Заказ П", "Ссылка на товар","Источник");	
		for($i=0; $i<count($tab); $i++){
			$exc2->SetCellValue($a[$i].$ii, $tab[$i]);
			$exc2->getStyle($a[$i].$ii)->getFont()->setBold(true);
		}

		$ii++;

		$comm=commodity::getOrdersCommodities($v["id"]);
		foreach ($comm as $kj => $vj) {
			
			$exc2->SetCellValue('A'.$ii, $vj["cat_name"]);
			$exc2->SetCellValue('B'.$ii, $vj["cod"]);
			// $exc2->SetCellValue('C'.$ii, $vj["category_id"]);
			$exc2->SetCellValue('C'.$ii, commodity::getTrans($vj["category_name"]));
			$exc2->SetCellValue('D'.$ii, $vj["com_name"]);
			$exc2->SetCellValue('E'.$ii, $vj["com_color"]);
			$exc2->SetCellValue('F'.$ii, $vj["com"]);
			$exc2->SetCellValue('G'.$ii, $vj["count"]);
			$exc2->SetCellValue('H'.$ii, $vj["price"]);
			$exc2->SetCellValue('I'.$ii, ($vj["price"]*$vj["count"])."".$vj["cur_show"] );
			$exc2->SetCellValue('J'.$ii, $vj["group_id"]);
			$exc2->SetCellValue('K'.$ii, "http://makewear.com.ua/product/{$vj['commodity_ID']}/{$vj['alias']}.html");
			$exc2->SetCellValue('L'.$ii, $vj["from_url"]);

			$ii++;
		}

		$ii+=2;
	}


	$today = date("d/m/Y"); 
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="orders'.$today.'.xls"');
	header('Cache-Control: max-age=0');
	
	$writer = PHPExcel_IOFactory::createWriter($exc, 'Excel5');
	$writer->save('php://output');


?>