<?php
//==============================================================================
//			Daminika    48-322        		
//============================================================================== 
//http://mwdev/parser/reports/07_Nov/catid_322_verify.html
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
/*
             //Подготовка переменных товара из парсинга для записи в бд
            parse:
            $comExist         = $resultParsArray['exist'];
            $price            = $resultParsArray["price"];
            $price2           = $resultParsArray["price2"];
            $comSizes         = $resultParsArray["sizes"];
            $comOptions       = $resultParsArray["options"];
            $comCount         = $resultParsArray['count'];
            $code             = $resultParsArray['cod'];
            $comName          = $resultParsArray['name'];
            $comFullDesc      = $resultParsArray['desc'];
            $comDuplicate     = $resultParsArray['existDub'][1];
 */
/*
    "cod" => $codProd, 
    "name" => $nameProd, 
    "exist" => $existProd,
    "price" => $price,
    "price2" => $price2, 
        "sizes" => $sizesProd, 
        "options" => $optionsProd, 
        'count' => $comCount,
        'desc' => $descProd,
    'existDub' => array($existDub, $duplicateProd));
*/
//var_dump($curLink);
//Exist URL
/* if ($verify !== "import" && ($statusCode == 404)) {
  $deleteProd = TRUE;
  return;
  } */

foreach ($saw->shop->offers->offer as $key => $offer) { // ~280

    $url = (string) $offer->url;
    
    if ($url == $curLink) {

        $imgMain = (string) $offer->picture[0];
        foreach ($offer->picture as $key => $value) {
            $imgDop      = (string) $value;
            $imgDopArr[] = $imgDop;
        }
        
        $nameProd  = $offer->name."";
        $codProd = $offer->vendorCode."";
        $price = $offer->price."";
        //$optionsProd   = "optionsProd/options";
        //$comCount      = "comCount/count";

        $arrayDesc  = deleteEmptyArrDescValues(explode("<p>", $offer->description));
        array_pop($arrayDesc);

        if (isset($arrayDesc)) {
           // $tmp = array_shift($arrayDesc);
            $searchArray = array('ткань:', 'длина изделия:', "длина рукава:");
            foreach ($arrayDesc as $key => $value) {
                $value = substr($value, 0, strpos($value, "</p>"));
                
                if($key == 0){
                    $descTmp = $value;
                    continue;
                }  
                $descProd = findStringDesc($value, $searchArray, $descProd);
                
                if (count($arrayDesc) == $key) {
                    $value = substr($value, 0, strpos($value, "<table"));
                }

                if (count($arrayDesc) == $key + 1) {
                    $descProd .= "<p><span>На фото размер:</span>".$offer->param[0]."</p>";
                    $descProd .= "<p><span>На фото рост модели:</span>".$offer->param[1]."</p>";
                    $descProd .= "<p><span>Описание:</span>".$descTmp."</p>";  
                }
            }
        }
    
    } else {
        continue;
    }
}

// size
    foreach ($saw->shop->offers->offer as $key => $offer) {
        if($codProd == $offer->vendorCode.""){
            $sizesProd .= $offer->param[2].';';           
        }
    }
    $sizesProd = substr($sizesProd, 0, -1);
//==============================================================================
//                   Если это проверщик то выходим из скрипта
//==============================================================================

    if ($verify == "verify") {
        return;
    }
