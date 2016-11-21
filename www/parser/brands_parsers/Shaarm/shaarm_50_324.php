<?php
//==============================================================================
//			Shaarm	50-324        		
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

// del header desc
unset($saw[0]);

/* 
$arrCod[];
foreach($saw as $val){

}
*/
//$arrCod[] = '';
foreach($saw as $value){
    $arrCod[] = $value[2]; 
}
$arrCod = array_values(array_unique($arrCod));

foreach($arrCod as $codKey => $cod){
    $i = 0;
    foreach($saw as $sawKey => $value){
        if($cod == $value[2] && $value[11] == 'В наличии'){
            if($i == 0){
                $arrAll[$codKey]['brandName']  = $value[0];
                $arrAll[$codKey]['nameProd']   = $value[1];
                $arrAll[$codKey]['$codProd']   = $value[2];
                $arrAll[$codKey]['price']      = $value[3];
                $arrAll[$codKey]['price2']     = 0;
                $arrAll[$codKey]['shortDesc']  = $value[5];
                $arrAll[$codKey]['features']   = $value[9];
                $arrAll[$codKey]['images']     = $value[10];
            }                              
                $arrAll[$codKey]['sizes'][$i]  = $value[6];
                $arrAll[$codKey]['colors'][$i] = $value[7];                             
            $i++;
        }
    }
}

var_dump($arrAll);
die;

// parser
$idBrand = 50;
$catId = '324';
//$catId      = $_SESSION['cat_id'];
$curLink = 'www';
//$curLink = $product['url'];

$resultParsArray = array(
    'cod'      => '123',
    'name'     => 'palto',
    'exist'    => TRUE,
    'price'    => 1250,
    'price2'   => 1285,
    'sizes'    => 'xxl',
    'options'  => '',
    'count'    => 2,
    'desc'     => '<h3>best palto</h3>',
    'existDub' => array(
        FALSE,
        ''
    )
);

