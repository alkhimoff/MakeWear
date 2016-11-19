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
            $allImgArr[] = (string) $value;
        }

        if (isset($allImgArr)) {
            $existIm = TRUE;        
            if ($verify == "verify") {
                deleteDopImgFromDB($commodityID, $mysqli);
            }            
            $srcProdArray['mainSrcImg'] = array_shift($allImgArr);

            foreach ($allImgArr as $value) {
                if ($srcProdArray['mainSrcImg'] !== $value) {
                    $srcProdArray['dopSrcImg'][] = $value;
                    //$existIm = TRUE;
                    $photoIdArray[]  = insertInShopImBd($commodityID, $mysqli);
                }
            }
        }
        break;
    }
}

if ($existIm == TRUE) {
    $photoIdArray[] = insertInShopImBd($commodityID, $mysqli);
    $nameImArray = array('title', 's_title', $photoIdArray);
    $brendName   = "daminika_images/";
    cropAndWriteImageBegin($srcProdArray, $commodityID, $nameImArray, $brendName, $idBrand);
}
