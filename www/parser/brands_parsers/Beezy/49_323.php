<?php
/**
 * Created by PhpStorm.
 * Date: 19.06.16
 * Time: 21:41
 */

namespace Parser;

use Parser\Provader\XML;
use Parser\Report\ReportParser;

require_once('import_verify_functions.php');

$vision      = new XML();
$newProducts = json_decode(file_get_contents($vision::NEW_PRODUCTS_BEEZY), true);

$step        = filter_input(INPUT_GET, 'step', FILTER_SANITIZE_NUMBER_INT);

if ($newProducts && $step == (count($newProducts) + 1)) {
    $_SESSION = array();

    die("Скрипт закочил Работу!!!");
}

$nextStep   = $step + 1;
$requestUrl = $domenName."/parser/parser_main.php?step={$nextStep}";
$saw        = null;
$verify     = "import";
$catId      = $_SESSION['cat_id'];
$idBrand    = $_SESSION['id'];
$product    = $newProducts[$step];
$countLinks    = count($newProducts);
$remeindLinks = $countLinks - $step;
$curLink = $product['url'];


//report
$report = new ReportParser($catId, $remeindLinks, $step, $curLink, $countLinks);
if (0 == $step) {
    $report->createFileReport();
}
$report->reportStart();

//Переменные для записи в БД по умолчанию
$existProd     = TRUE;
$deleteProd    = FALSE;
$insert        = FALSE;
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

$vision->getProductsFromDB($catId);

if (!in_array($product['url'], $vision->urlsFromDB)) {

    //article
    $codProd = $product['vendorCode'];

    //name
    $nameProd = $codProd == $product['name'] ?
        $product['name'] :
        str_replace($codProd, '', $product['name']);

    //price
    $price = ceil($product['price']);

    //price2
    $price2 = ceil($product['price2']);

    //sizes
    if (isset($product['colors'])) {
        if (isset($product['colors']['only'])) {
            $sizesProd = implode(';', $product['colors']['only']);
        } else {
            foreach ($product['colors'] as $color => $sizes) {
                $optionsProd .= $color.'='.implode(',', $sizes).';';
            }
            $optionsProd = substr($optionsProd, 0, -1);
        }
    }

    //images
    $images = array_filter($product['picture'], function($picture) {
        return is_string($picture) && strlen($picture) > 5;
    });

    if (isset($images['general'])){
        array_unshift($images, $images['general']);
    }

    $images = array_unique($images);

    if (count($images) < 1) {
        $existProd = false;
    }


    //description
    if ($product['description']) {
        if (mb_strpos($product['description'], 'Замеры', 0, 'utf-8')) {
            $product['description'] = mb_strstr($product['description'], 'Замеры', true, 'utf-8');
        }

        $descProd = '<p><span>Описание:</span>'.$product['description'].'</p>';
    }

} else {
    $existProd = false;
    $existDub  = true;
}

$resultParsArray = array(
    'cod'      => $codProd,
    'name'     => $nameProd,
    'exist'    => $existProd,
    'price'    => $price,
    'price2'   => $price2,
    'sizes'    => $sizesProd,
    'options'  => $optionsProd,
    'count'    => $comCount,
    'desc'     => $descProd,
    'existDub' => array(
        $existDub,
        $duplicateProd
    )
);
