<?php
//==============================================================================
//                       Lavana Fashion	39-242	         		
//==============================================================================
$existIm      = FALSE;
$srcProdArray = array('mainSrcImg' => "", 'dopSrcImg' => "");
$photoIdArray = array();
//--------------------------------Image-------------------------------------8---
$arrayImage   = checkEmptyOrChangeSelector($_SESSION['img'], $saw, 'img - главная картинка');

$srcProd = "";
if (isset($arrayImage)) {
    $lowSrc                     = str_replace("/303x454", "", $arrayImage[0]['src']);
    $srcProd                    = filterUrlImage($lowSrc, $curLink);
    $srcProdArray['mainSrcImg'] = $srcProd;
    $existIm                    = TRUE;
}
//--------------------------------DopImage----------------------------------9---
$arrayDopImage = checkEmptyOrChangeSelector($_SESSION["dopimg"], $saw, 'dopimg - дополнительны картинки');

$srcDopIm = "";
if (isset($arrayDopImage) & count($arrayDopImage) > 1) {
    if ($verify == "verify") {
        deleteDopImgFromDB($commodityID, $mysqli);
    }
    array_shift($arrayDopImage);
    foreach ($arrayDopImage as $value) {
        $srcDopIm = filterUrlImage($value['src'], $curLink);
        if ($srcProdArray['mainSrcImg'] !== $srcDopIm) {
            $srcProdArray['dopSrcImg'][] = str_replace("95x142", "375x562", $srcDopIm);
            $existIm                     = TRUE;
            $photoIdArray[]              = insertInShopImBd($commodityID, $mysqli);
        }
    }
}
//----------------------------CropandWrite images----------------------------10-
if ($existIm == TRUE) {
    if (!empty($srcProdArray['dopSrcImg'])) {
        $srcProdArray['dopSrcImg'] = array_values(array_unique($srcProdArray['dopSrcImg']));
    }
    $nameImArray = array('title', 's_title', $photoIdArray);
    $brendName   = "lavana_fashion/";
    cropAndWriteImageBegin($srcProdArray, $commodityID, $nameImArray, $brendName, $idBrand);
}

