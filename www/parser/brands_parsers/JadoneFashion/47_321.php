<?php
/**
 * Created by PhpStorm.
 * Date: 03.06.16
 * Time: 12:35
 */

use Parser\Provader\XML;
use Parser\Report\ReportParser;

require_once('import_verify_functions.php');

$jadone      = new XML();
$newProducts = json_decode(file_get_contents($jadone::NEW_PRODUCTS_JADONE), true);

$step        = filter_input(INPUT_GET, 'step', FILTER_SANITIZE_NUMBER_INT);

if ($newProducts && $step == (count($newProducts) + 1)) {
    $_SESSION = array();

    die("Скрипт закочил Работу!!!");
}

$nextStep     = $step + 1;
$requestUrl   = $domenName."/parser/parser_main.php?step={$nextStep}";
$saw          = null;
$verify       = "import";
$catId        = $_SESSION['cat_id'];
$idBrand      = $_SESSION['id'];
$product      = $newProducts[$step];
$countLinks   = count($newProducts);
$remeindLinks = $countLinks - $step;
$curLink      = $product['url'];


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

$jadone->getProductsFromDB($catId);

if (!in_array($product['url'], $jadone->urlsFromDB) &&
    !in_array($product['article'], $jadone->articlesFromDB)
) {

    //article
    $codProd = $product['article'];

    //name
    $nameProd = $codProd == $product['name'] ?
        $product['name'] :
        str_replace($codProd, '', $product['name']);

    //price
    $price = ceil($product['price']*1.5);

    //price2
    $price2 = ceil($product['price']);

    //sizes, colors, images - relations between image color and sizes
    if (isset($product['colors']) &&
        isset($product['colors']['color']) &&
        count($product['colors']['color']) > 0
    ) {
        //if more than one color
        if (isset($product['colors']['color'][0])) {
            foreach ($product['colors']['color'] as $key => $item) {

                $optionsProd .= $item['colorName'].'='.strtoupper($item['size']).';';

                if (0 == $key) {
                    $images['general'] = end($item['picture']);
                    reset($item['picture']);
                }

                foreach ($item['picture'] as $image) {
                    $images[] = $image;
                }
            }

            $optionsProd = $optionsProd ? substr($optionsProd, 0, -1) : '';

        } else {
            $optionsProd .= $product['colors']['color']['colorName'].'=';
            $optionsProd .= strtoupper($product['colors']['color']['size']);

                $images['general'] = end($product['colors']['color']['picture']);
                reset($product['colors']['color']['picture']);

            foreach ($product['colors']['color']['picture'] as $image) {
                $images[] = $image;
            }
        }

        //images
        $imagesProd = array_filter($images, function($picture) {
            return is_string($picture) && strlen($picture) > 5;
        });

        if (isset($images['general'])) {
            array_unshift($images, $images['general']);
        }

        $images = array_unique($images);

        if (count($images) < 1) {
            $existProd = false;
        }
    } else {
        $existProd = false;
    }

    //description
    if ($product['description']) {
        $descProd = strip_tags($product['description']);
        $trash = array("\n", "\t");
        $descProd = str_replace($trash, '', $descProd);
        $descProd = strstr($descProd, 'В нашем интернет', true);

        $descProd = $descProd ? '<p><span>Описание:</span>'.$descProd.'</p>' : '';
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
