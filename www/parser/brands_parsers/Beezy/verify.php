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

$idBrand  = 323;

//начальная запись отчета
$report = new ReportVerify($idBrand, 0, 0, "", 0);
$report->createFileReport();

$beezy = new XML();
$beezy
    ->copyXMLFileToDisc(XML::XML_URL_BEEZY, XML::XML_FILE_PATH_BEEZY)
    ->getDataFromXML(XML::XML_FILE_PATH_BEEZY)
    ->getProductsFromDB($idBrand);

$itemsFromDB = array_filter($visionFS->itemsFromDB, function($item) {
    return $item['visible'];
});

$products = new Products();

echo '<meta charset="utf-8"><pre>';



//processing xml data
$xmlOffersURLs = array();

//categories
$categories = array();
foreach ($beezy->xml->CATEGORIES as $category) {
    $category = json_decode(json_encode($category), true);
    $categories[$category['CATEGORY_IMG_IDS']] = $category['CATEGORY_LINKREWRITE_L1'];
}

foreach ($beezy->xml->SHOPITEM as $item) {

    $delimeter1 = '|:||.||:|';
    $delimeter2 = '|:|';
    $delimeter3 = '|!|';
    $delimeterImage = '|.|';
    $sizes      = '';
    $sizesColors= '';
    $colors     = array();

    $item = json_decode(json_encode($item), true);
    
    //url
    $url = 'http://e.beezy.com.ua/'.$categories[$item['CATEGORY_DEFAULT']].'/';
    $url .= $item['PRODUCT_ID'].'-'.$item['LINK_REWRITE_L1'].'.html';

    //colors sizes
    if (!is_array($item['ATTRIB_GROUPS'])) {
        foreach (explode($delimeter1, $item['ATTRIB_GROUPS']) as $items) {
            $parameters = explode($delimeter2, $items);

            $size  = explode($delimeter3, $parameters[0])[1];
            $color = count($parameters) == 1 ? 'only' : explode($delimeter3, $parameters[1])[1];
            $colors[$color][] = $size;
        }
    }
    
    if (count($colors) > 0) {
        if (isset($colors['only'])) {
            $sizes = implode(';', $colors['only']);
        } else {
            foreach ($colors as $color => $sizes) {
                $sizesColors .= $color.'='.implode(',', $sizes).';';
            }
            $sizesColors = substr($sizesColors, 0, -1);
        }
    }

    $xmlOffersURLs[$url] = array(
        'price'       => ceil($item['PRICE']),
        'price2'      => ceil($item['WHOLESALE_PRICE']),
        'sizes'       => $sizes,
        'sizesColors' => $sizesColors,
    );
}

//parse by price and sizes or sizeColors
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
        $retailPrice = $xmlOffersURLs[$url]['price'];
        $salePrice   = $xmlOffersURLs[$url]['price2'];

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
        
        //update colors sizes
        $sizesColors = $xmlOffersURLs[$url]['sizesColors'];
        if ($item['sizesColors'] != $sizesColors) {
            $products->updateCommoditySelect($item['id'], $sizesColors);
            $update = true;
            checkChanges(
                $item['sizesColors'],
                $sizesColors,
                'Изминились размеры и цвета:'
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
