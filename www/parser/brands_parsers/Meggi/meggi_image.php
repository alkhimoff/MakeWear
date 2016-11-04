<?php
//==============================================================================
//			Meggi	10-42 				
//==============================================================================
$existIm      = FALSE;
$srcProdArray = array('mainSrcImg' => "", 'dopSrcImg' => "");
$photoIdArray = array();

//Image
//$arrayImage = checkEmptyOrChangeSelector($_SESSION['img'], $saw, 'img - главная картинка'); //.bx_bigimages_aligner img
$arrayImage = checkEmptyOrChangeSelector('.bx_bigimages_aligner img', $saw, 'img - главная картинка'); //

$srcProd = "";
if (isset($arrayImage)) {
    $lowSrc                     = $arrayImage[0]['src'];
    $srcProd                    = filterUrlImage($lowSrc, $curLink);
    $srcProdArray['mainSrcImg'] = $srcProd;
    $existIm                    = TRUE;
}

//DopImage
//$arrayDopImage = checkEmptyOrChangeSelector($_SESSION["dopimg"], $saw, 'dopimg - дополнительны картинки');
$arrayDopImage = checkEmptyOrChangeSelector('.bx_slide ul li .cnt_item', $saw, 'dopimg - дополнительны картинки');


$srcDopIm = "";
if (isset($arrayDopImage)) {
    if ($verify == "verify") {
        deleteDopImgFromDB($commodityID, $mysqli);
    }
    foreach ($arrayDopImage as $value) {
       // $srcDopIm = filterUrlImage($value['style'], $curLink);
        $tmpImg = str_replace("background-image:url('/upload/iblock/", "", $value['style']);
        $tmpImg = str_replace("');", "", $tmpImg);
        $srcDopIm = 'http://www.meggi.com.ua/upload/iblock/' . $tmpImg;
        if ($srcProdArray['mainSrcImg'] !== $srcDopIm) {
            $srcProdArray['dopSrcImg'][] = $srcDopIm;
            $existIm                     = TRUE;
            $photoIdArray[]              = insertInShopImBd($commodityID, $mysqli);
        }
    }
}
/*
$srcDopIm = "";
if (isset($arrayDopImage)) {
    if ($verify == "verify") {
        deleteDopImgFromDB($commodityID, $mysqli);
    }
    foreach ($arrayDopImage as $value) {
        $srcDopIm = filterUrlImage($value['src'], $curLink);
        if ($srcProdArray['mainSrcImg'] !== $srcDopIm) {
            $srcProdArray['dopSrcImg'][] = $srcDopIm;
            $existIm                     = TRUE;
            $photoIdArray[]              = insertInShopImBd($commodityID,
                $mysqli);
        }
    }
}
 */
//CropandWrite images
if ($existIm == TRUE) {
    if (!empty($srcProdArray['dopSrcImg'])) {
        $srcProdArray['dopSrcImg'] = array_values(array_unique($srcProdArray['dopSrcImg']));
    }
    $nameImArray = array('title', 's_title', $photoIdArray);
    $brendName   = "meggi_images/";
    cropAndWriteImageBegin($srcProdArray, $commodityID, $nameImArray, $brendName, $idBrand);
}

