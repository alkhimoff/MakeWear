<?php
//==============================================================================
//			Dolcedonna  51-325        		
//==============================================================================
use Parser\Brand\AbstractBrand;
use Parser\Brand\NotAvailableCommodityException;

/**
 * @property $saw;
 * @property $excelJson;
 * @property $brandName;
 * @property $existProd;
 * @property $deleteProd;
 * @property $codProd;
 * @property $price;
 * @property $price2;
 * @property $sizesProd;
 * @property $colorsProd;
 * @property $optionsProd;
 * @property $comCount;
 * @property $nameProd;
 * @property $descProd;
 * @property $existDub;
 * @property $duplicateProd;
 */
class Dolcedonna extends AbstractBrand {
    
    public static $brandName = 'Dolcedonna';
    
    public function __construct($saw) {
        parent::__construct($saw);
        try{
             //$this->getJsonFile(51); // if exist new Exel file / param == idBrand
             $this->setExcelJson('brands_parsers/Dolcedonna/data.json');
             $this->setName();
             $this->setCodProd();
             $this->setFromJson();

             $this->setDescription();
            // $this->changeDescription();
        }catch(BrandException $e){
            return null;
        }
    }

    /**
     * Set exelJson, read json file
     * @param string $jsonPath
     */
    protected function setExcelJson($jsonPath){
        parent::setExcelJson($jsonPath);
        // del header desc / (excelJson[0])
        array_shift($this->excelJson);
    }
    
    /**
    * Set string nameProd
    */
    private function setName(){
        //$selector = $_SESSION["h1"]
        $this->nameProd = $this->getName('.g-row h1');
    /*    if($this->nameProd == NULL){
            $this->existProd = FALSE;
            throw new NotAvailableCommodityException;
        } */
    }
    
    private function setCodProd(){
        //$selector = $_SESSION[""]
        $this->codProd = trim(str_replace('Артикул:', '', $this->getCodProd('.product-details .g-row')));
    }

    /**
    * заполнение данными из json по коду товара
    * Set from json:
    * string $colorsProd;
    * string $sizesProd;
    * int $price
    * int $price2
    */
    private function setFromJson(){
        $existProd = FALSE;
        $x = 0;
        $colorsTmp = [];
        foreach($this->excelJson as $key => $value){  
            if($value[2] == $this->codProd){  
                if($x++ == 0){
                    $existProd = TRUE;
                    $this->price  = ceil(str_replace(',', '', $value[11])); // cut ',' from 3,900. = 3900
                    $this->price2 = ceil(str_replace(',', '', $value[10]));
                }
                $colorsTmp[] = $value[3];
                $this->sizesProd  .= $value[4] . ';';
                    //$this->descProd = strip_tags($value[9] . '; Состав: ' . $value[5]);                                                  
            }
        }
        $this->colorsProd = implode(';', array_unique($colorsTmp));//?
    }    

    
    protected function setDescription(){
        $arrDesc = $this->getDescription('.seo-text > p');
        // если в массиве нет слова... Описание то вставляем
        if(!strpos($arrDesc[0], 'Описание')){
            $this->descProd = 'Описание: ';
        }          
        foreach ($arrDesc as $value){
           $this->descProd .= $value .= ' ';
        }
        // добавляем ; в нужном месте для правильной разбивки строки на массив
        $this->descProd = str_replace('Состав:', ';Состав:', $this->descProd);
        
        $searchArray = array("описание:", "состав:");
        $this->changeDescription($searchArray); 
    }

}