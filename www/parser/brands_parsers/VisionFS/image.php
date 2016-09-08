<?php
/**
 * Created by PhpStorm.
 * Date: 03.06.16
 * Time: 12:34
 */
global $images;

$existIm = false;
$srcProdArray = array('mainSrcImg' => "", 'dopSrcImg' => "");
$photoIdArray = array();

//Image
$srcProd = "";
if (count($images) > 0) {
    $srcProdArray['mainSrcImg'] = isset($images[0]) ? $images[0] : $images[1];
    $existIm = true;
}

//additional photo
if (count($images) > 1) {
    foreach ($images as $key => $productImageAdditional) {

        //continue for main photo
        if (0 === $key) {
            continue;
        }

        $srcProdArray['dopSrcImg'][] = $productImageAdditional;
        $existIm = true;
        $photoIdArray[] = insertInShopImBd(
            $commodityID,
            $mysqli
        );
    }
}

$nameImArray = array('title', 's_title', $photoIdArray);

cropAndWriteImageBegin($srcProdArray, $commodityID, $nameImArray, '', $idBrand);
