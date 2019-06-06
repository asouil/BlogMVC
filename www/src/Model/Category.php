<?php

namespace App\Model;


class Category
{
    private $id;
    private $name;
    private $slug;

     /* Get the values of each properties */

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getSlug(){
        return $this->slug;
    }
}