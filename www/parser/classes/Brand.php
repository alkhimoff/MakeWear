<?php

namespace Parser;

use Parser\PHPExcelParser;

class Brand {       
    protected $saw;
    protected $excelJson;
    
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
    public function setPriceOpt($discount){     
        $proc = ceil($this->price / 100 * $discount);
        $this->price2 = ceil($this->price + $proc);
    } 
    
    /**
    * Change Description
    */ 
    public function changeDescription($searchArray){
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
    public function delDuplicateFromString(&$prop){
        $tmp = explode(';', $prop);
        $tmp = array_diff($tmp, ['']);
        $prop = implode(';', array_values(array_unique($tmp)));
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
            'existDub'=> [
                $this->existDub, 
                $this->duplicateProd
                        ] 
                ];
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
}
