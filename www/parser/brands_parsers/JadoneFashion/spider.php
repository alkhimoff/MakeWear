<?php
/**
 * Created by PhpStorm.
 * Date: 09.06.16
 * Time: 11:08
 */

use Parser\Report\ReportSpider;
use Parser\Provader\XML;

require_once('import_verify_functions.php');

set_time_limit(0);

//начальная запись отчета
$report = new ReportSpider(47, 0, 0, "", 0);
$report->createFileReport();
$report->reportStart();

//get xml file from url, get products from DB
$jadone = new XML();
$jadone
    ->copyXMLFileToDisc(XML::XML_URL_JADONE, XML::XML_FILE_PATH_JADONE)
    ->getDataFromXML(XML::XML_FILE_PATH_JADONE)
    ->getProductsFromDB(321);


//пошук товарів, які є в xml але нема в БД
$newProducts = array();
$i = 0;
$n = 0;
foreach ($jadone->xml->products->offer as $item) {
    $n++;
    if (!in_array($item->url->__toString(), $jadone->urlsFromDB) &&
        !in_array($item->vendorCode->__toString(), $jadone->articlesFromDB)
    ) {
        $item = json_decode(json_encode($item), true);
        $newProducts[] = $item;
        echo $i.' - '.$item['url'].'<br>';
        $i++;
    }
}

//save array of new products to file
file_put_contents($jadone::NEW_PRODUCTS_JADONE, json_encode($newProducts));

echo '<h1> Найлено '.count($newProducts).' новых товаров!</h1>';
$report->reportEnd();
exit;
