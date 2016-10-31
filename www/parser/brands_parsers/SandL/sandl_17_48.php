<?php
//==============================================================================
//                          S&L   	17-48         		
//==============================================================================
//-------------------Переменные для записи в БД по умолчанию--------------------
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
//var_dump($curLink);
//Exist URL
/* if ($verify !== "import") {
  $arrayExist = $saw->get($_SESSION['no_nal'])->toTextArray();
  //$arrayExist = array();
  //var_dump($arrayExist);
  if (!empty($arrayExist)) {
  $deleteProd = TRUE; //если только скрыть товар то коментируем
  return; //если только скрыть товар то коментируем
  }
  } */
//Exist
$arrayExist    = checkEmptyOrChangeSelector($_SESSION['no_nal'], $saw, 'no_nal - наличие');

if (!empty($arrayExist)) {
    $existProd = FALSE;
}

//Price price2
$arrayPrice = checkEmptyOrChangeSelector($_SESSION['price'], $saw, 'price - цена');

if (isset($arrayPrice)) {
    foreach ($arrayPrice as $key => $value) {
        if (strlen(trim($value)) !== 0) {
            $arrayPriceNew[] = trim($value);
        }
    }

    $regexp = '/[^0-9]/';
    foreach ($arrayPriceNew as $value) {
        $value  = mb_strtolower(trim($value), 'utf-8');
        $findme = "розн";
        $pos    = strpos($value, $findme);
        $findme = "опт";
        $pos1   = strpos($value, $findme);
        if ($pos1 !== FALSE) {
            $price2 = filterPrice(trim(strstr($value, ":")), $regexp);
        }
        if ($pos !== FALSE) {
            $price = ceil(filterPrice(trim(strstr($value, ":")), $regexp) * $_SESSION['updatePrice']);
            break;
        }
        //$price2 = ceil(1.15 * $price2);
    }
    if ($price == 0) {
        $existProd = FALSE;
        $price2    = 0;
    }
}

//Options
$arrayOptions = checkEmptyOrChangeSelector($_SESSION['sizeCol'], $saw, 'sizeCol - размер');

if (isset($arrayOptions)) {
    foreach ($arrayOptions as $value) {
        $findme = "ртик";
        $pos    = strpos(trim($value), $findme);
        if ($pos !== FALSE) {

            //Cod
            //$codProd = trim(strstr_after($value, ":"));
            $codProd = trim(substr(stristr($value, ":"), 1)); // удаляем первый символ(:) / вырезаем слово в коде
            //----------------------
            break;
        } else {
            $regexp = '/[^0-9-]/';
            if (preg_match($regexp, trim($value))) {
                $optionsProd = $optionsProd.";".trim($value)."=";
            } else {
                if (substr($optionsProd, -1) == "=") {
                    $optionsProd = $optionsProd.trim($value);
                } else {
                    $optionsProd = $optionsProd.",".trim($value);
                }
            }
        }
    }
    $optionsProd = substr($optionsProd, 1);
}
//==============================================================================
//                   Если это проверщик то выходим из скрипта
//==============================================================================
if ($verify == "verify") {
    return;
}

//Name
if (isset($arrayPriceNew)) {
    $nameProd = trim(strstr($arrayPriceNew[1], "№", true));
}

//Description
$arrayDesc = checkEmptyOrChangeSelector($_SESSION["desc"], $saw, 'desc - описание');

if (isset($arrayDesc)) {
    $arrayDesc   = deleteEmptyArrDescValues($arrayDesc);
    $wovels      = array("ткань:", "длина платья:", "длина рукава:", "застёжка:",
        "длина:", "длина сарафана:", "декор:", "застежка:",
        "длина блузы:", "длина рукава:", "длина рубашки:", "длина блузки:", "длина юбки:",
        "длина пиджака:");
    $searchArray = array("материал:", 'длина изделия:', 'длина рукава:', "ткань:",
        "длина платья:", "длина рукава:", "застёжка:",
        "длина:", "длина сарафана:", "декор:", "застежка:", "длина кардигана:", "длина рубашки:",
        "длина блузы:", "длина юбки:",
        "длина брюк:", "длина пиджака:", "длина блузки:");
    foreach ($arrayDesc as $key => $value) {
        $value = trim(str_replace(" :", ":", $value));
        if ($key == 0 && strpos($value, 'Материал:') != 0) {
            $descProd = getDesc($value, $descProd, $wovels, $searchArray);
        } else {
            if ($value == 'Материал:' || $value == 'Длина изделия:' || $value == 'Длина рукава:'
                ||
                $value == 'Длина кардигана:' || $value == 'Длина рубашки:' || $value
                == "Длина юбки:" ||
                $value == "Длина брюк:" || $value == "Длина блузы:" || $value == "Длина пиджака:") {
                $value .= $arrayDesc[$key + 1];
            }
            $descProd = findStringDesc($value, $searchArray, $descProd);
            if($key == 0 && $descProd == ""){
                $descProdTmp = $value;
            }
        }
    }
    $descProd .= "<p><span>Описание:</span>".$descProdTmp."</p>";
}


