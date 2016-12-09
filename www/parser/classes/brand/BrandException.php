<?php

namespace Parser\Brand;

class BrandException extends Exception {
    
    public function __construct() {
        //$class = getCalledClass();
        $this->existProd = FALSE;
    }
    
}
