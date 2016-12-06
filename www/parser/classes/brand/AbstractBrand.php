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
    
    /**
    * Change Description
    */ 
    protected function changeDescription($searchArray){
        if($searchArray == NULL){ 
            return;
        }
        $arrayDesc = explode(';', $this->descProd);
        $this->descProd = "";
        if (isset($arrayDesc)) {
            $arrayDesc   = deleteEmptyArrDescValues($arrayDesc);
            foreach ($arrayDesc as $key => $value) {
                $this->descProd = findStringDesc($value, $searchArray, $this->descProd);
            }   
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
    * 
    */
    //protected abstract function setBrandName();
    
    /**
    * Позднее статическое связывание
    */
    public static function getBrandName(){
        return static::$brandName;
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
    
    //$class = getCalledClass(); - узнать класс который вызывает методы абстрактного класса
}
