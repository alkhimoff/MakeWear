<?php
//==============================================================================
//			Shaarm	50-324 				
//==============================================================================
$existIm      = FALSE;
$srcProdArray = array('mainSrcImg' => "", 'dopSrcImg' => "");
$photoIdArray = array();

//$arrayImage   = checkEmptyOrChangeSelector($_SESSION['img'], $saw, 'img - главная картинка');
$arrayImage   = checkEmptyOrChangeSelector('#MagicToolboxSelectors17  a > img', $saw, 'img - главная картинка');

//--------------------------------MainImage-------------------------------------
if (isset($arrayImage)) {
    $mainImage = array_shift($arrayImage);
    $srcProdArray['mainSrcImg'] = $mainImage['src']; // извлекаем первый элемент массива
    $existIm                    = TRUE;
}
//--------------------------------DopImage--------------------------------------
foreach ($arrayImage as $value) {
    $srcProdArray['dopSrcImg'][] = $value['src'];
}
//$arrayDopImage = checkEmptyOrChangeSelector($_SESSION["dopimg"], $saw, 'dopimg - дополнительны картинки');
$arrayDopImage = $arrayImage;

$srcDopIm = "";
if (isset($arrayDopImage)) {
    if ($verify == "verify") {
        deleteDopImgFromDB($commodityID, $mysqli);
    }
    foreach ($arrayDopImage as $value) {
        $srcDopIm = $value['src'];
        if ($srcProdArray['mainSrcImg'] !== $srcDopIm) {
            $srcProdArray['dopSrcImg'][] = $srcDopIm;
            $existIm                     = TRUE;
            $photoIdArray[]              = insertInShopImBd($commodityID, $mysqli);
        }
    }
}
//----------------------------CropandWrite images-------------------------------
if ($existIm == TRUE) {
    if (!empty($srcProdArray['dopSrcImg'])) {
        $srcProdArray['dopSrcImg'] = array_values(array_unique($srcProdArray['dopSrcImg']));
    }
    $nameImArray = array('title', 's_title', $photoIdArray);
    $brendName   = "shaarm_images/";
    cropAndWriteImageBegin($srcProdArray, $commodityID, $nameImArray, $brendName, $idBrand);
}
