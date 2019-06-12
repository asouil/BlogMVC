<?php
//
// This is only a SKELETON file for the "Hamming" exercise. It's been provided as a
// convenience to get you started writing code faster.
//
class Bob
{
   /**
    * Respond to an input string
    *
    * @param string $str
    * @return string
    */
    public function respondTo($str)
    {
        //en majuscules (l'expression régulère doit être encadrée)
        if(ctype_upper($str)||(strtoupper($str)===$str && preg_match('/[A-Z]/', $str))) return "Whoa, chill out!";
        //si une question
        if(substr(trim($str),-1)==='?') return 'Sure.';
        //si chaîne vide
        if(!trim($str)) return 'Fine. Be that way!';
        //toute autre
        return 'Whatever.';
    }
}
