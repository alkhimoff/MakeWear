<?php
//==============================================================================
//			Tali Ttet   	41-300
//==============================================================================
//Переменные для записи в БД по умолчанию
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
/* $arrayExist = checkEmptyOrChangeSelector($_SESSION['no_nal'], $saw,
  'no_nal - наличие');
  //var_dump($arrayExist);

  if (isset($arrayExist)) {
  $exist = mb_strtolower(trim($arrayExist[0]), 'utf-8');
  $pos   = mb_strpos($exist, 'нет');
  $pos1  = mb_strpos($exist, "под зак");
  if ($pos !== false || $pos1 !== false) {
  $existProd = FALSE;
  }
  } */

//Price price2
$arrayPrice = checkEmptyOrChangeSelector($_SESSION['price'], $saw, 'price - цена');

if (isset($arrayPrice) && count($arrayPrice) == 1) {
    $regexp   = '/[^0-9.]/';
    $priceOld = filterPrice(trim($arrayPrice[0]), $regexp);
    $price    = ceil($priceOld * $_SESSION['updatePrice']);
    $price2   = intval($priceOld + ($priceOld - $priceOld * 1.2));
}

if ($price == 0) {
    $existProd = FALSE;
    $price2    = 0;
}

//Size
$arraySize = checkEmptyOrChangeSelector($_SESSION["sizeCol"], $saw, 'sizeCol - размер');

if (isset($arraySize)) {
    foreach ($arraySize as $value) {
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
    $codProd = trim($arrayCod[0]);
}

//Name
$arrayName = checkEmptyOrChangeSelector($_SESSION["h1"], $saw, 'name - название товара');

if (isset($arrayName)) {
    $nameProd = str_replace($codProd, '', trim($arrayName[0]));
}

//Description
$arrayDesc = checkEmptyOrChangeSelector($_SESSION["desc"], $saw, 'desc - описание');

if (isset($arrayDesc)) {
    $arrayDesc = deleteEmptyArrDescValues($arrayDesc);

    $strDesc = "";
    foreach ($arrayDesc as $value) {
        $strDesc .= trim($value)." ";
    }

    // get final description with html tags
    $wovels      = array("состав", "материалы", 'костюмная ткань:');
    $searchArray = array('состав:', "материалы:", 'костюмная ткань:');
    $descProd    = getDesc($strDesc, $descProd, $wovels, $searchArray);

    // if the line is still empty
    if ($descProd === '' && stripos($strDesc, '%') !== false) {
        $descProd = '<p><span>Состав:</span>'.$strDesc.'</p>';
    } else if ($descProd === '') {
        $descProd = '<p>'.$strDesc.'</p>';
    }
}
