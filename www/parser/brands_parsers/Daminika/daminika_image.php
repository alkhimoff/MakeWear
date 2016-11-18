<?php
//==============================================================================
//			Daminika    48-322 				
//==============================================================================
$existIm      = FALSE;
$srcProdArray = array('mainSrcImg' => "", 'dopSrcImg' => "");
$photoIdArray = array();

foreach ($saw->shop->offers->offer as $key => $offer) {
    $url = (string) $offer->url;
    ($urlTmp = substr($url, 0, strpos($url, "#"))) ? $url = $urlTmp : '';
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

if ($existIm == TRUE) {
    if ($verify == "verify") {
        deleteDopImgFromDB($commodityID, $mysqli);
    }
    $photoIdArray[] = insertInShopImBd($commodityID, $mysqli);
    $nameImArray = array('title', 's_title', $photoIdArray);
    $brendName   = "daminika_images/";
    cropAndWriteImageBegin($srcProdArray, $commodityID, $nameImArray, $brendName, $idBrand);
}
