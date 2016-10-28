<?php
//==============================================================================
//			Jhiva   	35-219         		
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
//--------------------------------Exist URL-------------------------------1-----
if ($verify !== "import" && ($statusCode == 404 || $statusCode == 410)) {
    $deleteProd = TRUE;
    return;
}

//Exist
$arrayExist = checkEmptyOrChangeSelector($_SESSION['no_nal'], $saw, 'no_nal - наличие');
//var_dump($arrayExist);

if (isset($arrayExist)) {
    foreach ($arrayExist as $value) {
        $exist = mb_strtolower(trim($value), 'utf-8');
        $pos1   = mb_strpos($exist, 'в наявності');
        $pos2  = mb_strpos($exist, 'під замов');
        if ($pos1 !== false || $pos2 !== false) {
            $existProd = TRUE;
            break;
        }
        $existProd = FALSE;
    }
}
//var_dump($existProd);
//----------------------------------Price-----------------------------------3---
$arrayPrice = checkEmptyOrChangeSelector($_SESSION['price'], $saw, 'price - цена');
//var_dump($arrayPrice);

if (isset($arrayPrice)) {
    $price = ceil(filterPrice(trim($arrayPrice[0]), '/[^0-9.]/') * $_SESSION['updatePrice']);
}

if ($price == 0) {
    $existProd = FALSE;
    $price2    = 0;
}
//var_dump($price);
//------------------------------------------------------------------------------
//                          Colors Size                                 
//------------------------------------------------------------------------------
//-------------------------------Size---------------------------------------4---
preg_match('/"options":(.*)\}],/', $pageBody, $matches);
//var_dump($matches);

if (isset($matches[1])) {
    $json = json_decode($matches[1], true);
    //var_dump($json);

    foreach ($json as $size) {
        $sizesProd .= ";".$size['name'];
    }
    $sizesProd = substr($sizesProd, 1);
}
if($sizesProd == ""){ ///
    $arraySize = checkEmptyOrChangeSelector($_SESSION["sizeCol"], $saw,'sizeCol - размер');

    if (isset($arraySize)) {
        foreach ($arraySize as $value) {
            $sizesProd = $sizesProd.trim($value).";";
        }
        $sizesProd = filterSizeColors($sizesProd);
    }
}
//--------------------------------Cod------------------------------------5-----
$arrayCod = checkEmptyOrChangeSelector($_SESSION["cod"], $saw, 'cod - код товара');

if (isset($arrayCod)) {
    $codProd = trim($arrayCod[0]);
   // $codProd = substr($codProd, -9, 6);
    $codProd = mb_substr($codProd, 9, 6, 'utf-8');
}
//var_dump($codProd);
//-----------------------------price2---------------------------------------6---
/*
if (file_exists('brands_parsers/Jhiva/price.json')) {
    $exelJson = file_get_contents('brands_parsers/Jhiva/price.json');
    if (isset($exelJson)) {
        $exelArray = json_decode($exelJson, true);
               // require_once 'C:\OpenServer\domains\localhost\dumphper.php';
                //dump($exelArray);
                //die();
    }
    if (isset($exelArray)) {
        foreach ($exelArray as $value) {
            if ($codProd == $value[1]) {
                $price2 = ceil($value[14]);
                break;
            } else {
                $price2 = 0;
            }
        }
    }
} else {
    echo "<h4 style='color:red'>\nПрайс не записался в json!!!</h4>";
}
 */

$price2 = $price;

if ($price2 == 0) {
    echo "<h4 style='color:red'>\nНет оптовой цены!!!Нет кода товара-{$codProd}, в прайсе jhiva!!!</h4>";
    $existProd = FALSE;
} else if ($price2 > $price) {
    $price2 = $price;
}
//var_dump($price2);
//==============================================================================
//                   Если это проверщик то выходим из скрипта
//==============================================================================
if ($verify == "verify") {
    return;
}
//--------------------------------Name------------------------------------7-----
$arrayName = checkEmptyOrChangeSelector($_SESSION["h1"], $saw, 'name - название товара');
//var_dump($arrayName);

if (isset($arrayName)) {
    $wovelIn  = array($codProd, 'Cукня', 'Спідниця', 'Штани');
    $wovelOut = array("", 'Платье', 'Юбка', 'Брюки');
    $nameProd = trim(str_replace($wovelIn, $wovelOut, $arrayName[0]));
}
//var_dump($nameProd);
//-------------------------------Description--------------------------------8---
$arrayDesc = checkEmptyOrChangeSelector($_SESSION["desc"], $saw, 'desc - описание'); 

$arrayDesc = deleteEmptyArrDescValues($arrayDesc);

if($arrayDesc == null){
    $arrayDesc = checkEmptyOrChangeSelector($_SESSION["desc"].' p', $saw, 'desc - описание');
}

if (isset($arrayDesc)) {
  
    $arrayDesc   = deleteEmptyArrDescValues($arrayDesc);
    $searchArray = array('матеріал:');
    foreach ($arrayDesc as $key => $value) {
        $value = str_replace('Матеріал', 'Материал', $value);
        if (str_replace('Матеріал', 'Материал', $value) == 'Материал') {
            $wovelsIn  = array(' ', 'Поліестер', 'Віскоза', 'Еластан', 'Вовна');
            $wovelsOut = array('', 'Полиэстер', 'Вискоза', 'Эластан', 'Шерсть');
            $descProd  = "<p><span>{$value}:</span>".str_replace($wovelsIn,
                    $wovelsOut, $arrayDesc[$key + 1]).'</p>';
        }
    }
    
            //require_once 'C:\OpenServer\domains\localhost\dumphper.php';
           // dump($saw);
            //die();
    $arrayProperty = $saw->get('.product-description .text')->toTextArray();
    $arrayProperty = deleteEmptyArrDescValues($arrayProperty);
/*
    if (!empty($arrayProperty)) {
        $descProd .= "<p>{$arrayProperty[0]}</p>";
    }
 * 
 */
    if (isset($arrayProperty)) {
    $beginSelectorP    = '<p>';
    $endSelectorP      = '</p>';
    $beginSelectorSpan = '<span>';
    $endSelectorSpan   = '</span>';
    $arrayDesc         = deleteEmptyArrDescValues($arrayProperty);
    $pos               = strpos($arrayDesc[0], ":");
    //if ($pos == FALSE) {
        $descProd = $beginSelectorP.$beginSelectorSpan."Описание: ".$endSelectorSpan.trim($arrayDesc[0]).$endSelectorP;
   // }
    }  
   // $tmp = $descProd;
    //$descProd .= "<p>{$arrayDesc[0]}</p>";
}
//var_dump($arrayDesc);
//var_dump($descProd);
//echo $descProd;
//die;
