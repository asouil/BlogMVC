<?php

namespace App\Model;


class Post
{
    private $id;
    private $name;
    private $slug;
    private $content;
    private $created_at;

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

    public function getContent(){
        return $this->content;
    }

    public function getCreatedAt(){
        $date= new \DateTime($this->created_at);
        return $date;
    }

}