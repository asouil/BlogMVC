<?php
//
// This is only a SKELETON file for the “Hamming” exercise. It’s been provided as a
// convenience to get you started writing code faster.
//
function toRna($strand)
{
    $arn='';
    //G s'attache à C et C s'attache à G, U s'attache à A et A s'attache à T
    for($i=0;$i<strlen($strand);$i++){
        if($strand[$i]=='A') $arn.='U';
        if($strand[$i]=='C') $arn.='G';
        if($strand[$i]=='T') $arn.='A';
        if($strand[$i]=='G') $arn.='C';
    }
    /** $dna = ['G'=>'C', 'C'=>'G', 'T'=>'A', 'A'=>'U']
     * |$arn=''
     * |foreach (str_split(strand) as $key => $value)
     * |$arn .= $dna['value'] return $arn 
     * ou //strtr remplace des caractères dans une chaîne strtr(string, array $pairs)
     * ||return strtr($strand, $dna)**/
    return $arn;
}