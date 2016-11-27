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

////////////$_SESSION['shaarmNameProd'] = []; // создать переменную в сессии
$COLORS = "";
//Name
//$arrayName = checkEmptyOrChangeSelector($_SESSION["h1"], $saw, 'name - название товара');
$arrName = checkEmptyOrChangeSelector('section #center_column h1', $saw, 'name - название товара');

if (isset($arrName)) {
    $nameProd  = trim($arrName[0]);
}

    // if exist new Exel file
 /* 
    use Parser\PHPExcelParser;
    $idBrand = 50;
    $exelDoc = new PHPExcelParser($idBrand);
    $exelDoc->writeJsonFile();
*/
// get json
$json = file_get_contents('brands_parsers/Shaarm/data.json');

if ($json) {
    $arrJson = json_decode($json, true);
    // del header desc
    array_shift($arrJson[0]);//unset($arrJson[0]);//не сдвигает массив
} else {
    die("Don't open json file");
}
// проверяет проверялся ли уже такой товар
if(isset($_SESSION['shaarmNameProd']) && $_SESSION['shaarmNameProd'] == $nameProd){ // + foreach
    $existProd = FALSE;
    return;
}
// заполнение данными из json по имени товара
foreach($arrJson as $key => $value){  
    //foreach($saw as $sawKey => $value){
        if($value[1] == $nameProd && $value == 'В наличии'){
            $i = 0;
            if($i == 0){
                //$arrJson[$key]['brandName']  = $value[0];
                //$arrJson[$key]['nameProd']   = $value[1];
                $codProd   = $value[2];
                $price      = $value[3];
                $price2     = 0;
                $descProd  = $value[5];
                $DESC2   = $value[9];
                //$arrJson[$key]['images']     = $value[10];
            }                              
                $value[6] ? $sizesProd.$value[6].";" : '';
                $value[7] ? $COLORS.$value[7].";" : '';                             
            $i++;
        }
    //}
}

$_SESSION['shaarmNameProd'][] = $nameProd;

if($sizesProd != NULL)
    $sizesProd = array_values(array_unique($sizesProd));
if($COLORS != NULL)
    $COLORS    = array_values(array_unique($COLORS));



use Parser\Brand;
$brand = new Brand();


$g = 0;








//require_once 'C:\OpenServer\domains\localhost\dumphper.php';
//dump($excelJsonArray);
//die;
/*
foreach($jsonArray as $value){
    $arrCod[] = $value[2]; 
}

    array_shift($arrCod);
    $arrCod = array_values(array_unique($arrCod));
//--------------
$existUrl = FALSE;

//Get Links
if (isset($arrCod)) {
    $countCod = count($arrCod);
    echo "Запарсено новых товаров: {$countCod}\n";

    $linksArr = $arrCod;
}
 
*/
/* if $saw != nokogiri
// del header desc
unset($saw[0]);
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
*/
