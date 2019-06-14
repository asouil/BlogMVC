<?php
//
// This is only a SKELETON file for the "Hamming" exercise. It's been provided as a
// convenience to get you started writing code faster.
//
function isIsogram($word)
{
    /*  *$let=range('a','z')
        *if (substr_count(strtolower($word), $let) > 1){return FALSE;}
        *return true;

        *count(array_unique($word))==count($word) << vérifie que chaque case est unique
        */
    $repeat=0;
    $word= strtolower(str_replace(['-',' '], '', $word));
    $word=preg_split('//u', $word, -1, PREG_SPLIT_NO_EMPTY);
    for ($i=0; $i<count($word); $i++) {
        for ($j=count($word); $j>=0; $j--) {
            if ($word[$i]===$word[$j]&&$i!==$j) {
                $repeat++;
            }
        }
    }
    return($repeat==0)?true:false;
}
