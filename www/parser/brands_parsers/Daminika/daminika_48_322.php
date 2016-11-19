<?php
//==============================================================================
//			Daminika    48-322        		
//============================================================================== 
//Переменные для записи в БД по умолчанию
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

($curLinkTmp = substr($curLink, 0, strpos($curLink, "#"))) ? $curLink = $curLinkTmp : '';
if($curLink == ""){
    $existProd = FALSE;
    return;
}

foreach ($saw->shop->offers->offer as $key => $offer) {
    $url = (string) $offer->url;
    ($urlTmp = substr($url, 0, strpos($url, "#"))) ? $url = $urlTmp : '';
   
    if ($url == $curLink) {
        $nameProd  = $offer->name."";
        $codProd = $offer->vendorCode."";
        
        $price = $offer->price."";      
        $proc = ceil($price / 100 * $_SESSION['per']);
        $price2 = ceil($price + $proc);

        // get an array of descriptions
        $arrayDesc  = deleteEmptyArrDescValues(explode("<p>", $offer->description));
        array_pop($arrayDesc);
        
        // cut if: 1. Красивое платье .....
        (@ substr($arrayDesc[0], 0, 2) == "1.") ? array_shift($arrayDesc) : '';       
        
        // parse description
        if (isset($arrayDesc)) {
            $descTmp = FALSE;
            $searchArray = array('ткань:', 'длина изделия:', "длина рукава:");
            
            foreach($arrayDesc as $key => $value) {
                ($valueTmp = substr($value, 0, strpos($value, "</p>"))) ? $value = $valueTmp : '';
                
                // cut table
                if (strpos($value, "<table")) {
                    ($valueTmp = substr($value, 0, strpos($value, "<table"))) ? $value = $valueTmp : '';
                    continue;
                }
                // description: ...
                if($key == 0){
                    $descTmp = $value;
                    continue;
                }  
                
                $descProd = findStringDesc($value, $searchArray, $descProd); // $value - возможно удалить html теги
            }
            
            ($tmp1 = $offer->param[0]."") ? $descProd .= "<p><span>На фото размер:</span>".$tmp1."</p>" : '';
            ($tmp2 = $offer->param[1]."") ? $descProd .= "<p><span>На фото рост модели:</span>".$tmp2."</p>" : '';
            ($descTmp) ? $descProd .= "<p><span>Описание:</span>".$descTmp."</p>" : '';          
        } 
        break;
    } else {
        continue;
    }
}

if ($price == 0 && $codProd == "") {
    $deleteProd = TRUE;
}
    
// sizes
foreach ($saw->shop->offers->offer as $key => $offer) {
    if($codProd == $offer->vendorCode.""){
        $sizeTmp = $offer->param[2].";";
        // if no: На фото размер...
        if($sizeTmp == ";"){
            $sizeTmp = $offer->param.";";
        }
        ($sizeTmp != ";") ? $sizesProd .= $sizeTmp : "";           
    }
}
$sizesProd = substr($sizesProd, 0, -1);