<?php
//==============================================================================
//			Daminika    48-322 				
//==============================================================================
$existIm      = FALSE;
$srcProdArray = array('mainSrcImg' => "", 'dopSrcImg' => "");
$photoIdArray = array();

foreach ($saw->shop->offers->offer as $key => $offer) {
    $url = (string) $offer->url;
    
    if ($url == $curLink) {
        foreach ($offer->picture as $key => $value) {
            $allImg      = (string) $value;
            $allImgArr[] = $allImg;
        }
        
        $allImgArr = array_values(array_unique($allImgArr));
        
        $srcProdArray['mainSrcImg'] = array_shift($allImgArr);
        $srcProdArray['dopSrcImg'] = $allImgArr;
        
        if($allImgArr != NULL){
            $existIm = TRUE;           
        }
        break;
    }
}

$srcDopIm = "";
if (isset($arrayDopImage)) {
    if ($verify == "verify") {
        deleteDopImgFromDB($commodityID, $mysqli);
    }
    foreach ($arrayDopImage as $value) {
        $srcDopIm = filterUrlImage($value['src'], $curLink);
        $wovels2  = array("s.jpg", "m.jpg");
        $srcDopIm = str_replace("s_", "_", $srcDopIm);
        $srcDopIm = str_replace($wovels2, ".jpg", $srcDopIm);
        $srcDopIm = str_replace($wovels, "_", $srcDopIm);
        if ($srcProdArray['mainSrcImg'] !== $srcDopIm) {
            $srcProdArray['dopSrcImg'][] = $srcDopIm;
            $existIm                     = TRUE;
            $photoIdArray[]              = insertInShopImBd($commodityID, $mysqli);
        }
    }
}

//CropandWrite images
if ($existIm == TRUE) {
    $photoIdArray[] = insertInShopImBd($commodityID, $mysqli);
    $nameImArray = array('title', 's_title', $photoIdArray);
    $brendName   = "daminika_images/";
    cropAndWriteImageBegin($srcProdArray, $commodityID, $nameImArray, $brendName, $idBrand);
}
