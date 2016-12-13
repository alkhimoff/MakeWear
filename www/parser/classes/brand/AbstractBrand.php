<?php

namespace Parser\Brand;

use Parser\PHPExcelParser;

abstract class AbstractBrand {       
    protected $saw;
    protected $excelJson;
    protected static $brandName;
    
    // Переменные для записи в БД по умолчанию
    protected $existProd;
    protected $deleteProd;
    protected $codProd;
    protected $price;
    protected $price2;
    protected $sizesProd;
    protected $colorsProd;
        protected $optionsProd;
        protected $comCount;
    protected $nameProd;
    protected $descProd;
    protected $existDub;
        protected $duplicateProd;
   
    protected function __construct($saw, $existProd = TRUE, $deleteProd = FALSE, $existDub = FALSE) {
        $this->saw = $saw;
        
        $this->existProd     = $existProd;
        $this->deleteProd    = $deleteProd;
        $this->codProd       = "";
        $this->price         = 0;
        $this->price2        = 0;
        $this->sizesProd     = "";
        $this->colorsProd    = "";
        $this->optionsProd   = "";
        $this->comCount      = "";
        $this->nameProd      = "";
        $this->descProd      = "";
        $this->existDub      = $existDub;
        $this->duplicateProd = "";
    }
    
    /**
     * 
     * @param type $selector
     * @return type
     */
    protected function getCodProd($selector){
        $arrayCod = checkEmptyOrChangeSelector($selector, $this->saw, 'cod - код товара');
        if (isset($arrayCod) && is_array($arrayCod)) {
            return $this->codProd  = trim($arrayCod[0]);
        }
        return FALSE;
    }
    
    /**
     * Create json file
     * @param int $idBrand
     */  
    protected function getJsonFile($idBrand){        
        $exelDoc = new PHPExcelParser($idBrand);
        $exelDoc->writeJsonFile(); 
    }
    
    /**
     * Set exelJson, read json file
     * @param string $jsonPath
     */
    protected function setExcelJson($jsonPath){
        $json = file_get_contents($jsonPath);

        if ($json) {
            $this->excelJson = json_decode($json, true);
        } else {
            die("Don't open json file");
        }
    }

    /**
    * Set string nameProd
    */
    protected function getName($selector){
        $nameProd = checkEmptyOrChangeSelector($selector, $this->saw, 'name - название товара');
        
        if (isset($nameProd) && is_array($nameProd)) {
            $nameProd  = trim($nameProd[0]);
        }
        return $nameProd;
    }
    
    /**
    * Set Price Opt
    */    
    protected function setPriceOpt($discount){     
        $proc = ceil($this->price / 100 * $discount);
        $this->price2 = ceil($this->price + $proc);
    } 
    
    protected function getDescription($selector){
        // $_SESSION['desc']
        return checkEmptyOrChangeSelector($selector, $this->saw, 'desc - описание');
    }
    
    /**
    * Change Description
    */ 
    protected function changeDescription($searchArray, $arrDescTmp = []){
        if (isset($arrDescTmp[0])) {
            $arrayDesc = $arrDescTmp;
        }else{
            $arrayDesc = explode(';', $this->descProd);
        }   
        $tmp = "";
        if (isset($arrayDesc)) {
            $arrayDesc   = deleteEmptyArrDescValues($arrayDesc);
            foreach ($arrayDesc as $value) {
                $tmp = findStringDesc($value, $searchArray, $tmp);
                                    //$this->descProd .= findStringDesc($value, $searchArray, $this->descProd);
            }
            $this->descProd = $tmp;
        }
    }
    
    /**
    * Del Duplicate sizes and colors
    */
    protected function delDuplicateFromString(&$prop){
        $tmp = explode(';', $prop);
        $tmp = array_diff($tmp, ['']);
        $prop = implode(';', array_values(array_unique($tmp)));
    }
    
    /**
    * Позднее статическое связывание
    */
    public static function getBrandName(){
        return static::$brandName;
    }
    
    public function getPrice($selector){
        return checkEmptyOrChangeSelector($selector, $this->saw, 'price - цена');;
    }

    /**
    * Get Result Array
    */
    public function getResultParsArray(){
        return [
            "cod"     => $this->codProd, 
            "name"    => $this->nameProd, 
            "exist"   => $this->existProd,
            "price"   => $this->price,
            "price2"  => $this->price2, 
            "sizes"   => $this->sizesProd, 
            "options" => $this->optionsProd, 
            'count'   => $this->comCount,
            'desc'    => $this->descProd,
            "delete"  => $this->deleteProd,
            'existDub'=> [
                $this->existDub, 
                $this->duplicateProd
                        ] 
                ];
    }
    
}
