<?php
//==============================================================================
//                      Shaarm	50-324	         		
//==============================================================================
$existUrl   = TRUE;
$pagination = [];

//Exist page
//$arrayPagination = checkEmptyOrChangeSelector('#pagination_next', $saw, 'pagination - страницы');
// to hand create the pager on 18 elements
for($j = 1; $j<=18; $j++){
    $arrayPagination[] = $j;
}

if (isset($arrayPagination)) {
    foreach ($arrayPagination as $value) {
        $regexp = '/[0-9]/';
        if (preg_match($regexp, $value)) {
            $pagination[] = (int) $value;
        }
    }
    $pagination = max($pagination);
    // $i is in spider_main.php
    if ($i == $pagination) {
        $existUrl = FALSE;
    }
} else {
    $existUrl = FALSE;
}

//Get Links
$arrayLinks = checkEmptyOrChangeSelector($_SESSION["a_href"], $saw, 'a_href - ссылки');

if (isset($arrayLinks)) {
    $countNewLinks = count($arrayLinks);
    echo "\nURL текущей ссылки:  <a href={$curLink} target='_blank' >{$curLink}</a>\n";
    echo "Запарсено новых ссылок: {$countNewLinks}\n";
    foreach ($arrayLinks as $key => $value) {
        $linksArr[] = trim($value['href']);
    }
}



// SELECT name FROM parser WHERE id=16
// if exist new Exel file
/* 
    use Parser\PHPExcelParser;
    $idBrand = 50;
    $exelDoc = new PHPExcelParser($idBrand);
    $exelDoc->writeJsonFile();
*/
/*
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
//--------------
$existUrl = FALSE;

//Get Links
if (isset($arrCod)) {
    $countCod = count($arrCod);
    echo "Запарсено новых товаров: {$countCod}\n";

    $linksArr = $arrCod;
}
 * */
 