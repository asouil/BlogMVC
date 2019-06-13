<?php
//
// This is only a SKELETON file for the "Hamming" exercise. It's been provided as a
// convenience to get you started writing code faster.
//
function squareOfSums($int)
{
    $result=0;
    for($i=0;$i<=$int;$i++){
        $result += $i;
    }

    return $result**2;
}

function sumOfSquares($int)
{
    $result=0;
    for($i=1;$i<=$int;$i++)
        $result+=$i**2;
    return $result;
}

function difference($int){
    return squareOfSums($int)-sumOfSquares($int);
}