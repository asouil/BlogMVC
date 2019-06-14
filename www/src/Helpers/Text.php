<?php

namespace App\Helpers;

class Text
{
    // la fonction devant être utilisée en dehors de propriétés, on y met static
    //il est mieux de travailler sur des variables si on doit modifier un paramètre
    public static function excerpt(string $content, int $limit = 100):string
    {
        //si la chaîne contient du html on retire le html avant de faire des manip sur $content
        /* $content = preg_replace('\<(.*?)>\','', $content) */
        $text=strip_tags($content);
        //mb_ permet de gérer les smileys comme un seul caractère
        //si la chaîne est plus petite que la limite donnée, on renvoit la chaîne telle qu'elle est
        if (mb_strlen($text)<=$limit) {
            return $text;
        }
        //on définit le dernier mot entier au delà de la limite
        $lastSpace= mb_strpos($text, ' ', $limit-1);
        //si le caractère de la limite est un espace
        if (!$lastSpace||$lastSpace==$limit) {
            return substr($text, 0, $limit).'...';
        }
        //on arrête après le dernier mot trouvé pour ne pas le tronquer
        if ($lastSpace!==$limit) {
            return substr($text, 0, $lastSpace).'...';
        }
    }
}
