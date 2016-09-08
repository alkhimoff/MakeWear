<?php
/**
 * Created by PhpStorm.
 * Date: 03.06.16
 * Time: 12:35
 */

use Parser\Report\ReportSpider;
use Parser\Provader\XML;

require_once('import_verify_functions.php');

set_time_limit(0);

//начальная запись отчета
$report = new ReportSpider(46, 0, 0, "", 0);
$report->createFileReport();
$report->reportStart();
$report->echoStart(0);

$visionFS = new XML();
$visionFS
    ->copyXMLFileToDisc(XML::XML_URL_VISION, XML::XML_FILE_PATH_VISION)
    ->getDataFromXML(XML::XML_FILE_PATH_VISION)
    ->getProductsFromDB(317);



//пошук товарів, які є в xml але нема в БД
$newProducts = array();
$i = 0;
$n = 0;
foreach ($visionFS->xml->shop->offers->offer as $item) {
    $n++;
    if (!in_array($item->url->__toString(), $visionFS->urlsFromDB) &&
        !in_array($item->vendorCode->__toString(), $visionFS->articlesFromDB)
    ) {
        $item = json_decode(json_encode($item), true);
        $general = $visionFS->xml->xpath("//offer[$n]/picture[@general=1]");
        if (count($general) > 0) {
             $item['picture']['general'] = $general[0]->__toString();
        }
        $newProducts[] = $item;
        echo $i.' - '.$item['url'].'<br>';
        $i++;
    }
}

//save array of new products to file
file_put_contents($visionFS::NEW_PRODUCTS_VISION, json_encode($newProducts));

echo '<h1> Найлено '.count($newProducts).' новых товаров!</h1>';
$report->reportEnd();
exit;
