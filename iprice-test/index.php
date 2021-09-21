<?php

require_once __DIR__ . '/vendor/autoload.php';

use IPrice\StringUtilities\DocumentGenerator;
use IPrice\StringUtilities\ConvertCase;
use IPrice\StringUtilities\Common\Constants;
use IPrice\StringUtilities\Common\FlagOptions;
class PriceTest{

    private static $pt_instance;

    private final function __construct() {
        $this->dg_instance = new DocumentGenerator();
        $this->cc_instance = new ConvertCase();
    }

    public static function instance(){
        if(!isset(self::$pt_instance)){
            self::$pt_instance = new PriceTest();
        }
        return self::$pt_instance;
    }

    public function toCSV($data, $fileName){
        $converted = $this->dg_instance->toCSV($data, $fileName);
    }

    public function stringConvert($data, $type){
        switch($type){
            case Constants::ALTERNATE_CASE:{
                return $this->cc_instance->toAlternateCase($data);
            }
            case Constants::LOWER_CASE:{
                return $this->cc_instance->toLowerCase($data);
            }
            case Constants::UPPER_CASE:{
                return $this->cc_instance->toUpperCase($data);
            }
            case Constants::FLIP_CASE:{
                return $this->cc_instance->toFLipCase($data);
            }
            default:{
                return $data;
            }
        }
    }
}



function runCommand($flag, $string){    
    $pt_instance = PriceTest::instance();    
    switch ($flag) {
        case FlagOptions::ALTERNATE_CASE:{
            return $pt_instance->stringConvert($string, Constants::ALTERNATE_CASE);
        }
        case FlagOptions::LOWER_CASE:{
            return $pt_instance->stringConvert($string, Constants::LOWER_CASE);
        }
        case FlagOptions::UPPER_CASE:{
            return $pt_instance->stringConvert($string, Constants::UPPER_CASE);
        }
        case FlagOptions::FLIP_CASE:{
            return $pt_instance->stringConvert($string, Constants::UPPER_CASE);
        }
        case FlagOptions::INCLUDE_CSV:{
            return $pt_instance->toCSV($string, time());
        }
        default:{
            throw new Exception("Invalid flag provided");
        }
    }
}


$optFlags = getopt("v:a::l::u::c::");

$csvFlag = isset($optFlags[FlagOptions::INCLUDE_CSV]) ?  true : false;
$convertFlag = null;

if(isset($optFlags[FlagOptions::UPPER_CASE])){
    $convertFlag = FlagOptions::UPPER_CASE;
}
if(isset($optFlags[FlagOptions::LOWER_CASE])){
    $convertFlag = FlagOptions::LOWER_CASE;
}
if(isset($optFlags[FlagOptions::ALTERNATE_CASE])){
    $convertFlag = FlagOptions::ALTERNATE_CASE;
}

try{
    if(isset($optFlags[FlagOptions::INCLUDE_VALUE])){
        $data = runCommand($convertFlag, $optFlags[FlagOptions::INCLUDE_VALUE]);
        if($csvFlag){
            runCommand(FlagOptions::INCLUDE_CSV, $data);
        }else{
            echo $data;
        }
    }else{
        throw new Exception("No String Provided");
    }
    
}catch(Exception $e){
    echo $e->getMessage();
}