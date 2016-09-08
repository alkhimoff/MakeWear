<?php
/**
 * Created by PhpStorm.
 * Date: 03.06.16
 * Time: 12:35
 */

namespace Parser;

use Parser\Provader\XML;
use Parser\Report\ReportParser;

require_once('import_verify_functions.php');

$vision      = new XML();
$newProducts = json_decode(file_get_contents($vision::NEW_PRODUCTS_VISION), true);

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

if (!in_array($product['url'], $vision->urlsFromDB) &&
    !in_array($product['vendorCode'], $vision->articlesFromDB)
) {

    //article
    $codProd = $product['vendorCode'];

    //name
    $nameProd = $codProd == $product['name'] ?
        $product['name'] :
        str_replace($codProd, '', $product['name']);

    //price
    $price = ceil($product['price']);

    //price2
    $price2 = ceil($product['price']/1.3);

    //sizes
    if (isset($product['param'])) {
        $sizesProd = is_array($product['param']) ?
            implode(';', array_unique($product['param'])) :
            $product['param'];
    } else {
        $sizesProd = '';
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
        $descProd = strip_tags($product['description']);
        $descProd = str_replace($nameProd, '', $descProd);
        $descProd = str_replace($codProd, '', $descProd);

        if (strpos($descProd, 'ждународный размер')) {
            $descProd = strstr($descProd, 'Международный размер', true);
        }

        $descProdArray = explode("\n\t", $descProd);

        $wovels = array(
            'размер',
            'рост модели',
            'состав:',
            'используемый материал:',
            'материал:',
            'цвета:',
            'длина:',
            'ткань:',
            'цвет:'
        );

        $searchArray = array(
            'размер:',
            "\n\tрост модели:",
            'состав:',
            'используемый материал:',
            'материал:',
            'цвета:',
            'длина:',
            'ткань:',
            'цвет:'
        );

        $descProdFinal       = '';
        $descProdDescription = '';
        foreach ($descProdArray as $item) {
            $span = false;
            foreach ($wovels as $wovel) {
                if (false !== strpos(mb_strtolower($item, 'utf-8'), $wovel)) {
                    $span = true;
                }
            }

            if ($span && $item) {
                $item = str_replace('.', '', $item);
                $descProdFinal .= getDesc($item, "", $wovels, $searchArray);
            } else {
                $descProdDescription .= $item;
            }
        }

        $descProd = $descProdFinal;
        $descProd .= $descProdDescription ? '<p><span>Описание:</span>'.$descProdDescription.'</p>' : '';
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
