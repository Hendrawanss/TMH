<?php

namespace App\Services;

class CheckInputService
{
    public function selectionChar($string1, $string2)
    {
        $counter = 0;
        $str1length = strlen($string1);
        $arrStr1 = str_split(strtolower($string1));

        foreach($arrStr1 as $c)
        {
            $charExist = substr_count($string2,$c);
            if($charExist > 0) {
                $counter++;
            }
        }

        return [
            "total" => $str1length,
            "exist" => $counter,
            "percentage" => (($counter/$str1length)*100)."%"
        ];
    }
}