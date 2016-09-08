<?php
/**
 * Created by PhpStorm.
 * Date: 10.05.16
 * Time: 18:24
 */

require_once '../../vendor/autoload.php';

define('BLOB_STORAGE', getenv('BLOB_STORAGE'));

use Modules\MySQLi;

set_time_limit(0);

$blob = new \Modules\BlobStorage();

//foreach ($blob->getListAllContainers()->getContainers() as $key => $value) {
//    $blob->deleteContainer($value->getName());
//}

//containers - images, email, email-letters, banners, assets (banners).
//$blob->createContainer('assets');

// 1 - шлях до файла, 2 - назва файла як він буде назв. в сторейджі, 3 - назва папки в сторейджі
//$blob->uploadBlob(
//    'base7.jpg',
//    'base7-c.jpg',
//    'assets'
//);
$blob->uploadBlob(
    'sp-special-c.jpg',
    'sp-special-co.jpg',
    'assets'
);
$blob->uploadBlob(
    'opt-5-items-c.jpg',
    'opt-5-items-co.jpg',
    'assets'
);


//var_dump($blob->getBlob('fashion-look', ''));
//$blob->deleteBlob('email-letters', 'sp3.html');
var_dump($blob->getListBlobsInContainer('assets'));
//$blob->setBlobCacheControl('11132', 'title.jpg');
//$blob->deleteContainer('container');
//var_dump($blob->isContainer('email-letters'));
//$blob->deleteAllBlobsInContainer('container1');

/*
$db   = MySQLi::getInstance()->getConnect();

$result = $db->query(<<<QUERY
    SELECT DISTINCT commodity_ID comId
    FROM shop_commodity
    WHERE commodity_visible = 1
QUERY
);

if ($result && $result->num_rows > 0) {
    $containers = array();

    while ($row = $result->fetch_object()) {
        $containers[] = $row->comId;
    }

    foreach ($containers as $key => $container) {

        if ($key < 176) continue;

        $blobsInContainer = $blob->getListBlobsInContainer((string)$container);

        if (count($blobsInContainer > 1)) {

            echo "--- $key ---<br>";

            foreach ($blobsInContainer as $blobInContainer) {
                $blob->setBlobCacheControl((string)$container, $blobInContainer);

                echo $container.' - '.$blobInContainer.'<br>';

                usleep(20000);
            }

            echo '<hr>';
            flush();
            ob_flush();
        }

//        if ($key > 10) break;
    }
} else {
    echo 'MySQLi Error!';
}
*/
/*$images = scandir('../../parser/uploads/images_fl');
foreach ($images as $key => $image) {

    if ('.' == $image || '..' == $image) {
        continue;
    }

    $blob->uploadBlob(
        '../../parser/uploads/images_fl/'.$image,
        $image,
        'fashion-look'
    );
    echo $key.'<br>';
    flush();
    ob_flush();
}*/
