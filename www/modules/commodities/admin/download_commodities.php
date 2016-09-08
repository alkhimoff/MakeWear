<?php
/**
 * Created by PhpStorm.
 * Date: 05.04.16
 * Time: 12:31
 */

namespace Modules\Prices;

$type   = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
$format = filter_input(INPUT_GET, 'format', FILTER_SANITIZE_STRING);


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="products.'.$format.'"');
header('Cache-Control: max-age=0');

$feeds = new FeedsLoad();

if ('price' === $type) {
    $feeds->products[0] = array(
        'ID',
        'Бренд',
        'Артикул',
        'Категория',
        'Наименование',
        'Цвет',
        'Размер',
        'Описание',
        'Destination URL',
        'Image URL',
        'UAH'
    );

    $products = $feeds->getAllProducts2();
} elseif ('feeds' === $type) {
    $products = $feeds->getAllProducts();
} else {
    $feeds->products[0] = array(
        'Категория',
        'Название',
        'Описание',
        'Цвет',
        'Размер'
    );

    $products = $feeds->getAllProducts1();
}

if ('csv' === $format) {
    $fp = fopen('php://output', 'w');

    foreach ($products as $line) {
        fputcsv($fp, $line, ',');
    }

    fclose($fp);
} elseif ('xls' === $format) {
    $objPHPExcel = new \PHPExcel();

    $objPHPExcel->getActiveSheet()->fromArray($products);

    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(60);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(60);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);

    $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
}

