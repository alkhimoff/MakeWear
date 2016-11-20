<?php
//==============================================================================
//                      Shaarm	50-324	         		
//==============================================================================

// if exist new Exel file
/* 
    use Parser\PHPExcelParser;
    $idBrand = 50;
    $exelDoc = new PHPExcelParser($idBrand);
    $exelDoc->writeJsonFile();
*/
$json = file_get_contents('brands_parsers/Shaarm/data.json');

if ($json) {
    $jsonArray = json_decode($json, true);
} else {
    die("Don't open Json file");
}
//require_once 'C:\OpenServer\domains\localhost\dumphper.php';
//dump($excelJsonArray);
//die;
//
foreach($jsonArray as $value){
    $arrCod[] = $value[2]; 
}

    array_shift($arrCod);
    $arrCod = array_values(array_unique($arrCod));


