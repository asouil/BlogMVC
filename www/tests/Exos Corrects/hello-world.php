<?php

function helloWorld(string $name = "")
{
    if ($name) {
        return 'Hello, '.ucwords(strToLower($name)).'!';
    }
    //ici on pouvait également utiliser ucfirst($name) pour mettre seulement la première lettre en majuscule
    return 'Hello, World!';
}
