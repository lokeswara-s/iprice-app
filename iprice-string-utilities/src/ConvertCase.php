<?php 

namespace IPrice\StringUtilities;

use IPrice\StringUtilities\Common\Constants;
use IPrice\StringUtilities\Interfaces\IConvertCase;

class ConvertCase implements IConvertCase
{

    private $ASCII_UPPER_INDEX = 65;
    private $ASCII_LOWER_INDEX = 90;
    private $ASCII_LOWER_START_INDEX = 97;
    private $ASCII_LOWER_END_INDEX = 122;
    private $ASCII_VARIANCE = 32;

    protected function charCaseConvert($char, $case){
        $ascii = ord($char);
        if(!$this->isInAsciiRange($ascii)){
            return $char;
        }
        switch ($case) {
            case Constants::UPPER_CASE:{
                if($ascii >= $this->ASCII_LOWER_START_INDEX && 
                $ascii <= $this->ASCII_LOWER_END_INDEX){
                    return chr($ascii - $this->ASCII_VARIANCE);
                }else{
                    return $char;
                }
            }
            case Constants::LOWER_CASE:{
                if($ascii <= $this->ASCII_LOWER_INDEX && 
                $ascii >= $this->ASCII_UPPER_INDEX){
                    return chr($ascii + $this->ASCII_VARIANCE);
                }else{
                    return $char;
                }
            }
            case Constants::ALTERNATE_CASE:
            case Constants::FLIP_CASE:{
                if($this->isInAsciiRange($ascii)){
                    if($this->isLowerCaseCharacter($ascii)){
                        return $this->charCaseConvert($char, Constants::UPPER_CASE);
                    }
                    if($this->isUpperCaseCharacter($ascii)){
                        return $this->charCaseConvert($char, Constants::LOWER_CASE);
                    }
                }
                return $char;
            }
            default:{
                return $char;
            }
        }
    }

    public function toUpperCase($string){
        return $this->stringIteraterator($string, Constants::UPPER_CASE);
    }

    public function toLowerCase($string){
        return $this->stringIteraterator($string, Constants::LOWER_CASE);
    }

    public function toFlipCase($string){
        return $this->stringIteraterator($string, Constants::FLIP_CASE);
    }

    public function toAlternateCase($string){
        $updated_string ="";
        if(isset($string)){
            for($index= 0; $index < strlen($string); $index++){
                if($index % 2 === 0){
                    $updated = $this->charCaseConvert($this->toLowerCase($string[$index]), Constants::LOWER_CASE);
                    $updated_string = $updated_string.$updated;
                }else{
                    $updated = $this->charCaseConvert($this->toLowerCase($string[$index]), Constants::UPPER_CASE);
                    $updated_string = $updated_string.$updated;
                }
            }
        }
        return $updated_string;
    }

    private function stringIteraterator($string, $type){
        $updated_string ="";
        if(isset($string)){
            for($index= 0; $index < strlen($string); $index++){
                $updated = $this->charCaseConvert($string[$index], $type);
                $updated_string = $updated_string.$updated;
            }
        }
        return $updated_string;
    }

    private function isInAsciiRange($number){
        if($this->isLowerCaseCharacter($number) || $this->isUpperCaseCharacter($number)){
            return true;
        }
        return false;
    }

    private function isUpperCaseCharacter($number){
        return $number >= $this->ASCII_UPPER_INDEX && $number <= $this->ASCII_LOWER_INDEX;
    }

    private function isLowerCaseCharacter($number){
        return $number >= $this->ASCII_LOWER_START_INDEX && $number <= $this->ASCII_LOWER_END_INDEX;
    }

    protected function stringToArray($string){
        $array = [];
        for($index= 0; $index < strlen($string); $index++){
            array_push($array, $string[$index]);
        }
        return $array;
    }
 
}