<?php

namespace IPrice\StringUtilities\Interfaces;

interface IConvertCase{
    
    public function toUpperCase($string);
    public function toLowerCase($string);
    public function toAlternateCase($string);
    public function toFlipCase($string);
    
}
