<?php
//==============================================================================
//			Dolcedonna  51-325 				
//==============================================================================
$existIm      = FALSE;
$srcProdArray = array('mainSrcImg' => "", 'dopSrcImg' => "");
$photoIdArray = array();

$arrayImage  = checkEmptyOrChangeSelector('.slider-pagination a img', $saw, 'img - главная картинка');

//--------------------------------MainImage-------------------------------------
if (isset($arrayImage)) {
    $mainImage = array_shift($arrayImage);// извлекаем первый элемент массива
    $imgDomen = 'http://dolcedonna.com.ua';
    $srcProdArray['mainSrcImg'] = $imgDomen . str_replace('small', 'large', $mainImage['src']); // меняем маленькое изображение на большое, изменением адреса
    $existIm = TRUE;
}
//--------------------------------DopImage--------------------------------------
/*
foreach ($arrayImage as $value) {
    $srcProdArray['dopSrcImg'][] = 'http://dolcedonna.com.ua' . $value['src'];
}
*/
//$arrayDopImage = checkEmptyOrChangeSelector($_SESSION["dopimg"], $saw, 'dopimg - дополнительны картинки');
$arrayDopImage = $arrayImage;

$srcDopIm = "";
if (isset($arrayDopImage)) {
    if ($verify == "verify") {
        deleteDopImgFromDB($commodityID, $mysqli);
    }
    foreach ($arrayDopImage as $value) {
        $srcDopIm = $imgDomen . str_replace('small', 'large', $value['src']);
        if ($srcProdArray['mainSrcImg'] !== $srcDopIm) {
            $srcProdArray['dopSrcImg'][] = $srcDopIm;
            $existIm        = TRUE;
            $photoIdArray[] = insertInShopImBd($commodityID, $mysqli);
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


