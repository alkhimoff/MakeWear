<?php
//==============================================================================
//                       Lavana Fashion	39-242	         		
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
//--------------------------------Exist URL-------------------------------1-----
if ($verify !== "import" && ($statusCode == 404)) {
    $deleteProd = TRUE;
    return;
}
//--------------------------------Exist-----------------------------------2-----
$arrayExist = checkEmptyOrChangeSelector($_SESSION['no_nal'], $saw, 'no_nal - наличие');

if (isset($arrayExist)) {
    foreach ($arrayExist as $value) {
        $value  = mb_strtolower(trim($value), 'utf-8');
        $findme = 'нет в нал';
        $pos    = mb_strpos($value, $findme);
        if ($pos !== false) {
            $existProd = FALSE;
            break;
        }
    }
}

//Exist depends foto
$arrayImage = checkEmptyOrChangeSelector($_SESSION['img'], $saw, 'img - главная картинка');

if (!isset($arrayImage)) {
    $existProd = FALSE;
}
//---------------------------Price price2-----------------------------------3---
//Price
/*
$arrayPrice = checkEmptyOrChangeSelector($_SESSION['price'], $saw, 'price - цена');

if (isset($arrayPrice)) {
    $regexp = '/[^0-9.]/';
    $price = ceil(filterPrice(trim($arrayPrice[1]), $regexp) * $_SESSION['updatePrice']);
}
*/
//price2
$arrayPrice2 = checkEmptyOrChangeSelector($_SESSION['price2'], $saw,  'price - цена');

if (isset($arrayPrice2)) {
    $arrayPrice2 = deleteEmptyArrDescValues($arrayPrice2);
    $regexp      = '/[^0-9.]/';
    $price2      = filterPrice(trim($arrayPrice2[1]), $regexp);
    $price       = ceil($price2 + ($price2/2));
}

if ($price == 0) {
    $existProd = FALSE;
    $price2    = 0;
}
//------------------------------------------------------------------------------
//                          Colors Size                                 
//------------------------------------------------------------------------------
//-------------------------------Size---------------------------------------4---
preg_match("/new Product.Config\((.*)\);/", $pageBody, $matches);

if (isset($matches[1])) {
    $json       = json_decode($matches[1], true);
    $arraySize  = $json['attributes'][180]['options'];
   // $arrayColor = $json['attributes'][92]['options'];
}

if (isset($arraySize)) {
    foreach ($arraySize as $value) {
        $sizesProd = $sizesProd.trim($value['label']).";";
    }
    $sizesProd = filterSizeColors($sizesProd); 
}
/*
if (isset($arrayColor)) { 
    $descProdColor = "<p><span>Цвет:</span>";
    foreach ($arrayColor as $value) {
        $descProdColor .= trim(mb_strtolower($value['label'], "utf-8"))."</p>";
    }
    //$descProdColor = filterSizeColors($descProd);
}
*/
//==============================================================================
//                   Если это проверщик то выходим из скрипта
//==============================================================================
if ($verify == "verify") {
    return;
}
//--------------------------------Cod------------------------------------5-----
$arrayCod = checkEmptyOrChangeSelector($_SESSION['cod'], $saw, 'cod - код товара');

if (isset($arrayCod)) {
    $arrayCod = deleteEmptyArrDescValues($arrayCod);
    $codProd  = trim($arrayCod[1]);
}
//--------------------------------Name------------------------------------6-----
$arrayName = checkEmptyOrChangeSelector($_SESSION['h1'], $saw, 'name - название товара');

if (isset($arrayName)) {
    $arrayName = deleteEmptyArrDescValues($arrayName);
    $nameProd  = trim($arrayName[0]);
}
//-------------------------------Description--------------------------------7---
$arrayDesc = checkEmptyOrChangeSelector($_SESSION['desc'], $saw, 'desc - описание');
    
if (isset($arrayDesc)) {
    $arrayDesc   = deleteEmptyArrDescValues($arrayDesc);
    $searchArray = array('состав:', 'размеры:', "длина гольфа:", "длина рукава:",
        "длина брюк:", "длина изделия:", "длина кофты:","длина юбки:", "на модели", 
        "параметры модели:", "цвет:", "длина свитшота:", "длина майки:", "рост модели");
    foreach ($arrayDesc as $key => $value) {
        $descProd = findStringDesc($value, $searchArray, $descProd);
        if (count($arrayDesc) == $key + 1) {
            $descProd .= $descProdColor."<p><span>Описание:</span>".$arrayDesc[$key]."</p>"; 
        }
    }
}
//==============================================================================
//                          Проверка на дубликаты
//==============================================================================
//--------------------Проверяем по главной картинке дубликаты-------------2-----
if (empty($duplicate)) {
    $duplicate[] = "";
}

foreach ($duplicate as $value) {
    if ($value == $codProd) {
        $existProd = FALSE;
        $existDub  = TRUE;
        break;
    } else {
        $_SESSION["duplicateArray"][] = $codProd;
        $_SESSION["duplicateArray"]   = array_unique($_SESSION["duplicateArray"]);
    }
}
$duplicateProd = $codProd;


