<?php
/**
 * Created by PhpStorm.
 * User: pham
 * Date: 28/03/2017
 * Time: 10:07
 */

namespace App\Helpers;


class StringHelper
{
    public static function pascalCaseToCamelCase($string, $capitalizeFirstCharacter = false)
    {
        $str = str_replace('_', '', ucwords($string, '_'));

        if (!$capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }

        return $str;
    }

    public static function stringToArray($string, $delimiter){
        try{
            $inputTrimSpace = str_replace(' ', '', $string);
            $valueArray = explode($delimiter, $inputTrimSpace);
            return $valueArray;
        }
        catch(\Exception $ex){
            return array();
        }
    }
}