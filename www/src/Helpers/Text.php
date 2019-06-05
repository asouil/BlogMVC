<?php

namespace App\Helpers;

class Text {
    // la fonction devant être utilisée en dehors de propriétés, on y met static
    public static function excerpt(string $content, int $limit=100):string
    {
        //mb_ permet de gérer les smileys comme un seul caractère
        if(mb_strlen($content)<=$limit){
            //si la chaîne est plus petite que la limite donnée, on renvoit la chaîne telle qu'elle est
            return $content;
        }
        //on définit le dernier mot entier au delà de la limite
        $lastSpace= mb_strpos($content, ' ', $limit);
        //on arrête après le dernier mot trouvé pour ne pas le tronquer
        return substr($content, 0, $lastSpace).'...';

    }

}