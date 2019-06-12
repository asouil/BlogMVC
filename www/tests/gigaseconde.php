<?php
//
// This is only a SKELETON file for the "Hamming" exercise. It's been provided as a
// convenience to get you started writing code faster.
//
function from(\DateTime $from)
{
    //$date=time('0031-08-06 01:46:40');
    $from=(clone $from)->modify((10**9).' sec');
    return $from;
    

}
