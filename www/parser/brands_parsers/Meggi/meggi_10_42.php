<?php
//==============================================================================
//			Meggi	10-42	        		
//==============================================================================
//-------------------Переменные для записи в БД по умолчанию--------------------
$existProd     = TRUE;
$deleteProd    = FALSE;
$codProd       = "";
$price         = 0;
$price2        = 0;
$sizesProd     = "";
$optionsProd   = "";
$comCount      = "";
$nameProd      = "";
$descProd      = "";
$existDub      = FALSE;
$duplicateProd = "";
//var_dump($curLink);
//Exist URL
/* if ($verify !== "import" && ($statusCode == 404)) {
  $deleteProd = TRUE;
  return;
  } */
//Exist
$arrayExist    = checkEmptyOrChangeSelector($_SESSION['no_nal'], $saw, 'no_nal - наличие');
$arrayNewPrice = $saw->get('span.productPrice-ofd')->toTextArray();

if (isset($arrayExist) || !empty($arrayNewPrice)) {
    $existProd = FALSE;
} else {
    $existProd = TRUE;
}

//Price price2
$arrayPrice = checkEmptyOrChangeSelector($_SESSION['price'], $saw, 'price - цена');

if (isset($arrayPrice)) { 
    // удаляем мелоч
    $price2 = strstr(trim($arrayPrice[0]), ".", true);
    $regexp = '/[^0-9]/';
    $price2 = filterPrice($price2, $regexp);
    //$price  = (int) ceil($price2 * 1.6 * $_SESSION['updatePrice']);
    //$price2 = ceil(1.15 * $price2); 
    $proc = $price2 / 100 * $_SESSION['per'];
    $price = ceil($price2 + $proc);
}

if ($price == 0) {
    $existProd = FALSE;
    $price2    = 0;
}

//Size 
$arraySize = checkEmptyOrChangeSelector($_SESSION["sizeCol"], $saw, 'sizeCol - размер'); 

if (isset($arraySize)) {
    $arraySize = deleteEmptyArrDescValues($arraySize);
    foreach ($arraySize as $value) {
        if($value == '-'){
            continue;
        }
        $sizesProd = $sizesProd.trim($value).";";
    }
    $sizesProd = filterSizeColors($sizesProd);
}
//==============================================================================
//                   Если это проверщик то выходим из скрипта
//==============================================================================
if ($verify == "verify") {
    return;
}

//Cod
$arrayCod = checkEmptyOrChangeSelector($_SESSION["cod"], $saw, 'cod - код товара');

if (isset($arrayCod)) {
    //$codProd = trim(strstr_after($arrayCod[0], "-"));         // некорректная работа если в коде 2 искомых символа
    $codProd = trim(substr(stristr($arrayCod[0], "-"), 1));     // удаляем первый символ(-) / вырезаем слово в коде
}

//Name
$arrayName = checkEmptyOrChangeSelector($_SESSION["h1"], $saw, 'name - название товара');

if (isset($arrayName)) {
    $wovels   = array($codProd, "-");
    $nameProd = trim(str_replace($wovels, "", $arrayName[0]));
}

//Description
$arrayDesc      = checkEmptyOrChangeSelector($_SESSION["desc"], $saw, 'desc - описание');

if (isset($arrayDesc)) {
    $arrayDesc   = deleteEmptyArrDescValues($arrayDesc);
    foreach ($arrayDesc as $key => $value) {
        $descProd .= $value;
        $descProd .= ' ';
    }
}

//Color
//$arrayDescColor = checkEmptyOrChangeSelector('.bx_scu > ul .bx_active .cnt .cnt_item[title]', $saw, 'color - описание цвета');// Найти

if (isset($arrayDescColor)) {
    $beginSelectorP    = '<p>';
    $beginSelectorSpan = '<span>';
    $endSelectorSpan   = '</span>';
    $endSelectorP      = '</p>';
    $descProd          = $beginSelectorP.$beginSelectorSpan."Цвет:".$endSelectorSpan.trim($arrayDescColor[0]).$endSelectorP;
}
/*
if (isset($arrayDesc)) {
    $arrayDesc   = deleteEmptyArrDescValues($arrayDesc);
    $searchArray = array('состав изделия:');
    foreach ($arrayDesc as $key => $value) {
        $value .= ":";
        if ($value == 'Состав изделия:') {
            $value .= trim($arrayDesc[$key + 1]);
        }
        $descProd = findStringDesc($value, $searchArray, $descProd);
    }
}
*/