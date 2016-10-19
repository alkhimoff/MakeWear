<?php
//==============================================================================
//			seventeen 	16-47         		
//==============================================================================
//-------------------Переменные для записи в БД по умолчанию--------------------
$existProd     = TRUE; // будет опубликован
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

//Exist URL
/* if ($verify !== "import" && ($statusCode == 404)) {
  $deleteProd = TRUE;
  return;
  } */
//Exist
$arrayExist = checkEmptyOrChangeSelector($_SESSION['no_nal'], $saw, 'no_nal - наличие');

if (isset($arrayExist)) {
    $codPrice   = str_replace("http://seventeen.com.ua/shop/", "", $curLink);
    $codPrice   = strstr($codPrice, "/", true);
    
    // цена
    $arrayPrice = checkEmptyOrChangeSelector('.id-good-'.$codPrice.'-price', $saw, 'price - цена');  
  
    // цена со скидкой
    $newPrice = checkEmptyOrChangeSelector('span.newprice', $saw,'new-price - цена со скидкой');

    if($newPrice){
        // если нет по селектору ..-price ищем по -oldprice // значит есть цена со скидкой
        $arrayPrice = checkEmptyOrChangeSelector('.id-good-'.$codPrice.'-oldprice', $saw, 'price - цена');
    }
    
    // если есть цена или цена со скидкой
    ($arrayPrice || $newPrice)
         ? $existProd = TRUE : $existProd = FALSE;  
    
    if($arrayPrice || $newPrice){
        $regexp = '/[^0-9]/';
        if($newPrice){
            $price2 = filterPrice(trim($newPrice[0]), $regexp);
        }else{
            $price2 = filterPrice(trim($arrayPrice[0]), $regexp);
        }

        // action discount 40%
        // $price  = ceil(($price2 + 70) * $_SESSION['updatePrice']);
        $price  = ceil(($price2 + $_SESSION['per']) * $_SESSION['updatePrice']);
    }
    
    if ($price2 == 0) {
        $existProd = FALSE;
        $price     = 0;
    }
       
    $arraySize = checkEmptyOrChangeSelector($_SESSION["sizeCol"], $saw,'sizeCol - размер');

    if (isset($arraySize)) {
        foreach ($arraySize as $value) {
            if (strstr($value, "пояс") == FALSE) {
                $sizesProd = $sizesProd.trim($value).";";
            }
        }
        $sizesProd = filterSizeColors($sizesProd);
    }
      
    $pos1  = strpos($arrayExist[0],"Нет в наличии!");
    $pos2 = strpos($arrayExist[0], "Замена цвет");
    $pos3 = strpos($arrayExist[0], "Ожидается");
    
    // если: Нет в наличии, ...
    if($pos1 === FALSE && $pos2 === FALSE && $pos3 === FALSE){
        $existProd = TRUE;
    }else{
        $existProd = FALSE;
    } 

}else{
    $existProd = FALSE;
    return;
}
//==============================================================================
//                   Если это проверщик то выходим из скрипта
//==============================================================================
if ($verify == "verify") {
    return;
}

//Cod
$arrayCod = checkEmptyOrChangeSelector($_SESSION["cod"], $saw, 'cod - код товара');

if (isset($arrayCod)) {
    $codProd = preg_replace("/\D/", "", trim($arrayCod[0]));
}

//Name
$arrayName = checkEmptyOrChangeSelector($_SESSION["h1"], $saw, 'name - название товара');

if (isset($arrayName)) {
    $nameProd = trim(str_replace($codProd, "", trim($arrayName[0])));
}

//Description
$arrayDesc = checkEmptyOrChangeSelector($_SESSION['desc'], $saw, 'desc - описание');

if (isset($arrayDesc)) {
    $beginSelectorP    = '<p>';
    $endSelectorP      = '</p>';
    $beginSelectorSpan = '<span>';
    $endSelectorSpan   = '</span>';
    $arrayDesc         = deleteEmptyArrDescValues($arrayDesc);
    $pos               = strpos($arrayDesc[0], ":");
    if ($pos == FALSE) {
        $descProd = $beginSelectorP.$beginSelectorSpan."Описание: ".$endSelectorSpan.trim($arrayDesc[0]).$endSelectorP;
    }
    $searchArray = array('материал:', 'длина изделия:', "цвет:", "длина рукава:",
        "воротник:", "длина изделия по боковой части:", "длина:",
        "декор:", "длина кофты:", "длина штанов по шагу:", "длина рукава от горловины:",
        "длина по боковому шву:", "по шагу:", "по боковому шву:",
        "боковому шву:", "длина изделия на фото:", "длина брюк по шагу:", "длина брюк в поясе по резинке:");
    foreach ($arrayDesc as $key => $value) {
        $descProd = trim(findStringDesc($value, $searchArray, $descProd));
    }
}
