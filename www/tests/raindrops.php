<?php
//
// This is only a SKELETON file for the "Hamming" exercise. It's been provided as a
// convenience to get you started writing code faster.
//
function raindrops($num)
{
    $nom='';
    if($num%3==0) $nom.='Pling';
    if($num%5==0) $nom.='Plang';
    if($num%7==0) $nom.='Plong';
    if(!$nom) $nom.=$num;
    return $nom;
    
}