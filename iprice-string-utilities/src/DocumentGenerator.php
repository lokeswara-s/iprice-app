<?php

namespace IPrice\StringUtilities;

use IPrice\StringUtilities\ConvertCase;
use IPrice\StringUtilities\Common\Constants;

class DocumentGenerator extends ConvertCase{
   
    public function __construct(){
        // intial config if necessary
    }

    public function toCSV($string, $fileName){
        $array = $this->stringToArray($string);
        $rows = array ($array);
        
        $f_instance = fopen($fileName.'.csv', 'w');
        
        foreach ($rows as $fields) {
            fputcsv($f_instance, $fields);
        }
        
        fclose($f_instance);

        return true;
    }
}