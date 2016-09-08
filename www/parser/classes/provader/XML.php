<?php
/**
 * Created by PhpStorm.
 * Date: 09.06.16
 * Time: 11:26
 */

namespace Parser\Provader;

use Modules\Products;

/**
 * Class XML
 * @package Parser\Provader
 */
class XML
{
    const XML_URL_VISION         = 'http://visionfs.com.ua/index.php?route=feed/yandex_market';
    const XML_URL_JADONE         = 'http://jadone.biz/index.php?route=feed/yandex_market';
    const XML_URL_BEEZY          = 'http://e.beezy.com.ua/modules/nvn_export_products/download/nvn_products_export_y3IkmiLMCN.xml';
    const XML_URL_SK_HOUSE       = 'http://sk-house.ua/Catalog/PrintPromua';
    const XML_FILE_PATH_JADONE   = 'uploads/xml/jadone.xml';
    const XML_FILE_PATH_VISION   = 'uploads/xml/vision.xml';
    const XML_FILE_PATH_BEEZY    = 'uploads/xml/beezy.xml';
    const XML_FILE_PATH_SK_HOUSE = 'uploads/xml/sk-house.xml';
    const JSON_FILE_PATH_SK_HOUSE = 'uploads/xml/sk-house.json';
    const NEW_PRODUCTS_VISION    = 'uploads/new_products_json/vision.json';
    const NEW_PRODUCTS_JADONE    = 'uploads/new_products_json/jadone.json';
    const NEW_PRODUCTS_BEEZY     = 'uploads/new_products_json/beezy.json';

    public $xml;
    public $urlsFromDB     = array();
    public $articlesFromDB = array();
    public $itemsFromDB    = array();

    /**
     * Get data from local xml file.
     * @param string $path - local path to xml file.
     * @param bool $cdata
     * @return $this
     */
    public function getDataFromXML($path, $cdata = false)
    {
        if ($cdata) {
            $this->xml = simplexml_load_file($path, 'SimpleXMLElement', LIBXML_NOCDATA);
        } else {
            $this->xml = simplexml_load_file($path);
        }

        return $this;
    }

    /**
     * Copy xml file from supplier site to local.
     * @param string $urlFrom
     * @param string $pathTo
     * @return $this
     */
    public function copyXMLFileToDisc($urlFrom, $pathTo)
    {
        copy($urlFrom, $pathTo);

        return $this;
    }

    /**
     * Find products by brand id.
     * @param int $brandId
     * @return $this
     */
    public function getProductsFromDB($brandId)
    {
        $products = new Products();
        $productsFromDB = $products->findByBrandId($brandId);

        foreach ($productsFromDB as $product) {
            $this->articlesFromDB[] = $product->cod;
            $this->urlsFromDB[]     = $product->fromUrl;
            $this->itemsFromDB[$product->fromUrl] = array(
                'price'       => $product->retailPrice,
                'sizes'       => $product->sizes,
                'sizesColors' => $product->sizesColors,
                'id'          => $product->id,
                'visible'     => $product->visible,
            );
        }

        return $this;
    }
}
