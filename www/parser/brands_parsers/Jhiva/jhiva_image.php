<?php
//==============================================================================
//			Helen Laven	32-217				
//==============================================================================
$existIm      = FALSE;
$srcProdArray = array('mainSrcImg' => "", 'dopSrcImg' => "");
$photoIdArray = array();
//--------------------------------Image-------------------------------------8---
$arrayImage   = checkEmptyOrChangeSelector($_SESSION['img'], $saw, 'img - главная картинка');
//$arrayImage   = checkEmptyOrChangeSelector('.gallery-link', $saw, 'img - главная картинка');

$srcProd = "";
if (isset($arrayImage)) {
    $mainPhoto = array_shift($arrayImage); // извлекаем первый элемент массива
    $srcProd                    = "http://jhiva.com.ua{$mainPhoto['href']}";
    $srcProdArray['mainSrcImg'] = $srcProd;
    $existIm                    = TRUE;
}
//--------------------------------DopImage----------------------------------9---
//$arrayDopImage = checkEmptyOrChangeSelector($_SESSION["dopimg"], $saw, 'dopimg - дополнительны картинки');
$arrayDopImage = $arrayImage;

$srcDopIm = "";
if (isset($arrayDopImage)) {
    if ($verify == "verify") {
        deleteDopImgFromDB($commodityID, $mysqli);
    }
    foreach ($arrayDopImage as $value) {
        $srcDopIm = "http://jhiva.com.ua{$value['href']}";
        if ($srcProdArray['mainSrcImg'] !== $srcDopIm) {
            $srcProdArray['dopSrcImg'][] = $srcDopIm;
            $existIm                     = TRUE;
            $photoIdArray[]              = insertInShopImBd($commodityID, $mysqli);
        }
    }
}
//var_dump($srcProdArray);
//----------------------------CropandWrite images----------------------------10-
if ($existIm == TRUE) {
    if (!empty($srcProdArray['dopSrcImg'])) {
        $srcProdArray['dopSrcImg'] = array_values(array_unique($srcProdArray['dopSrcImg']));
    }
    $nameImArray = array('title', 's_title', $photoIdArray);
    $brendName   = "jhiva_images/";
    cropAndWriteImageBegin($srcProdArray, $commodityID, $nameImArray, $brendName, $idBrand);
}
//==============================================================================
