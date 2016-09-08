<?php
/**
 * Created by PhpStorm.
 * Date: 03.06.16
 * Time: 12:35
 */

use Parser\Report\ReportVerify;
use Modules\Products;
use Parser\InterfaceAdmin;
use Parser\Provader\XML;

require_once('import_verify_functions.php');

set_time_limit(0);

$idBrand  = 321;

//начальная запись отчета
$report = new ReportVerify($idBrand, 0, 0, "", 0);
$report->createFileReport();

$jadone = new XML();
$jadone
    ->copyXMLFileToDisc(XML::XML_URL_JADONE, XML::XML_FILE_PATH_JADONE)
    ->getDataFromXML(XML::XML_FILE_PATH_JADONE)
    ->getProductsFromDB($idBrand);

$itemsFromDB = array_filter($jadone->itemsFromDB, function($item) {
    return $item['visible'];
});

$products = new Products();

echo '<meta charset="utf-8"><pre>';

//processing xml data
$xmlOffersURLs = array();
foreach ($jadone->xml->products->offer as $item) {

    $item = json_decode(json_encode($item), true);

    //sizes
    $sizes = '';
    if (isset($item['colors']) &&
        isset($item['colors']['color']) &&
        count($item['colors']['color']) > 0
    ) {
        //if more than one color
        if (isset($item['colors']['color'][0])) {
            foreach ($item['colors']['color'] as $key => $color) {
                $sizes .= $color['colorName'].'='.strtoupper($color['size']).';';
            }

            $sizes = $sizes ? substr($sizes, 0, -1) : '';

        } else {
            $sizes .= $item['colors']['color']['colorName'].'=';
            $sizes .= strtoupper($item['colors']['color']['size']);
        }
    }

    $xmlOffersURLs[$item['url']] = array(
        'price2' => (int) $item['price'],
        'sizes' => $sizes,
    );
}

//comparing by price and sizes
$step         = 1;
$countLinks   = count($itemsFromDB);
$updatedItems = array();

foreach ($itemsFromDB as $url => $item) {

    $update        = false;
    $visibleUpdate = false;
    $remindLinks   = $countLinks - $step;
    $salePrice     = 0;
    $retailPrice   = 0;
    $sizes         = '';


    $report = new ReportVerify($idBrand, $remindLinks, $step, $url, $countLinks);
    $report->reportStart();

    //update visible
    if (!key_exists($url, $xmlOffersURLs)) {
        $products->setVisible($item['id'], 0);
        $visibleUpdate = true;
        $update = true;
        echo $report::STRING_NOEXIST;
    } else {

        //update price
        $retailPrice = ceil($xmlOffersURLs[$url]['price2']*1.5);
        $salePrice   = ceil($xmlOffersURLs[$url]['price2']);

        if ($item['price'] != $retailPrice) {
            $products->updateReatilPrice($item['id'], $retailPrice);
            $products->updateSalePrice($item['id'], $salePrice);
            $update = true;

            checkChanges(
                $item['price'],
                $retailPrice,
                'Изменилась цена:'
            );
        }

        //update sizes
        $sizes = $xmlOffersURLs[$url]['sizes'];
        if ($item['sizes'] != $sizes) {
            $products->updateSizes($item['id'], $sizes);
            $update = true;

            checkChanges(
                $item['sizes'],
                $sizes,
                'Изминились размеры:'
            );
        }
    }

    $report->echoUpdateProd(
        $update,
        $item['id'],
        '', //article
        '', //name
        $retailPrice,
        $salePrice,
        $sizes,
        '', //options
        ''  //com count
    );

    //записываем данные в файл отчета и в интерфейс
    $content = $report->reportEnd();
    InterfaceAdmin::init($idBrand, $countLinks)
        ->setInterfaceVerify(
            $step,
            $content,
            $update,
            $visibleUpdate
        );

    $step++;

    if ($update) {
        $updatedItems[] = $item['id'];
    }
//    break;
}

//summery
$countUpdated = count($updatedItems);
$report->reportStart();

echo '<br>===========================================<br>';
echo "\n<h1 style='color:blue'>Обновлено {$countUpdated} товаров!</h1>";

foreach ($updatedItems as $updatedItem) {
    echo "<span style='color:blue'>ID = {$updatedItem}</span><br>";
}

$content = $report->reportEnd();

InterfaceAdmin::init($idBrand, $countLinks)
    ->setInterfaceVerify(1, $content, 0, 0);


function checkChanges($propOld, $propNew, $str)
{
    if ($propOld !== $propNew) {
        $from    = array('<', '>');
        $to      = array('&lt;', '&gt;');
        $propOld = str_replace($from, $to, $propOld);
        $propNew = str_replace($from, $to, $propNew);
        echo "\n<span style='color:blue'>{$str}</span> Старое знач.({$propOld}); Новое знач.({$propNew})\n";
    }
}

exit;
