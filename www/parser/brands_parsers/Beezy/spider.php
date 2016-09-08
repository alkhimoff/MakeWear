<?php
/**
 * Created by PhpStorm.
 * Date: 10.06.16
 * Time: 15:51
 */

use Parser\Report\ReportSpider;
use Parser\Provader\XML;

require_once('import_verify_functions.php');

set_time_limit(0);

//начальная запись отчета
$report = new ReportSpider(49, 0, 0, "", 0);
$report->createFileReport();
$report->reportStart();

//get xml file from url, get products from DB
$beezy = new XML();
$beezy
//    ->copyXMLFileToDisc(XML::XML_URL_BEEZY, XML::XML_FILE_PATH_BEEZY)
    ->getDataFromXML(XML::XML_FILE_PATH_BEEZY, true)
    ->getProductsFromDB(323);


//categories
$categories = array();
foreach ($beezy->xml->CATEGORIES as $category) {
    $category = json_decode(json_encode($category), true);
    $categories[$category['CATEGORY_IMG_IDS']] = $category['CATEGORY_LINKREWRITE_L1'];
}

//пошук товарів, які є в xml але нема в БД
$newProducts = array();
$i = 0;
$n = 0;
foreach ($beezy->xml->SHOPITEM as $item) {

    $delimeter1 = '|:||.||:|';
    $delimeter2 = '|:|';
    $delimeter3 = '|!|';
    $delimeterImage = '|.|';

    $item = json_decode(json_encode($item), true);
    $itemParsed = array();
    $url = 'http://e.beezy.com.ua/'.$categories[$item['CATEGORY_DEFAULT']].'/';
    $url .= $item['PRODUCT_ID'].'-'.$item['LINK_REWRITE_L1'].'.html';


    $itemParsed['url']     = $url;
    $itemParsed['vendorCode'] = $item['REFERENCE'];
    $itemParsed['name']    = $item['PRODUCT_NAME_L1'];
    $itemParsed['price']   = ceil($item['PRICE']);
    $itemParsed['price2']  = ceil($item['WHOLESALE_PRICE']);
    $itemParsed['picture']  = explode($delimeterImage, $item['IMAGES']);

    //colors sizes
    if (is_array($item['ATTRIB_GROUPS'])) {
        $itemParsed['colors'] = array();
    } else {
        foreach (explode($delimeter1, $item['ATTRIB_GROUPS']) as $colors) {
            $parameters = explode($delimeter2, $colors);

            $size  = explode($delimeter3, $parameters[0])[1];
            $color = count($parameters) == 1 ? 'only' : explode($delimeter3, $parameters[1])[1];
            $itemParsed['colors'][$color][] = $size;
        }
    }

    //descriptions
    $desc1 = is_array($item['DESCRIPTION_L1']) ? '' : strip_tags($item['DESCRIPTION_L1']);
    $desc2 = strip_tags($item['DESCRIPTION_SHORT_L2']);

    $trash = 'Если вы ищете где купить ветровку из мембранной ткани – ';
    $trash .= 'то предлагаем вам обратиться в соответствующий раздел, ';
    $trash .= 'чтобы найти ближайший к вам магазин или комфортный интернет магазин.';

    $itemParsed['description'] = $desc2.str_replace($trash, '', $desc1);

    $n++;
    if (!in_array($itemParsed['url'], $beezy->urlsFromDB)) {
        $newProducts[] = $itemParsed;
        echo $i.' - '.$itemParsed['url'].'<br>';
        $i++;
    }

//    break;
}

//save array of new products to file
file_put_contents($beezy::NEW_PRODUCTS_BEEZY, json_encode($newProducts));

echo '<h1> Найлено '.count($newProducts).' новых товаров!</h1>';
$report->reportEnd();
exit;
