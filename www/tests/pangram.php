<?php
//
// This is only a SKELETON file for the "Hamming" exercise. It's been provided as a
// convenience to get you started writing code faster.
//
function isPangram($string)
{
    $alphabet=str_split('abcdefghijklmnopqrstuvwxyz');
    //array_intersect renvoie les lettres communes entre les deux tableaux
    return empty(array_diff($alphabet, str_split(strtolower($string))));
}