<?php

    function distance(string $a, string $b){
        if(strlen($a)!==strlen($b)) throw new \Exception('opération invalide');
        $distance=0;
        for($i=0; $i <strlen($a); $i++){
            if($a[$i]!==$b[$i]) $distance++;
        }
        return $distance;
        //autre méthode avec str_pad qui ajoute des espaces pour avoir la même longueur entre les deux chaînes
        //count(array_diff_assoc(str_split(str_pad($a,strlen($b)-strlen($a),' ')), str_split(str_pad($b,strlen($a)-strlen($b),' '))));
    }