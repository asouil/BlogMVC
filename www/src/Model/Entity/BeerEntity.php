<?php
namespace App\Model\Entity;

use Core\Model\Entity;

use Core\Controller\Helpers\TextController;

class BeerEntity extends Entity
{
    private $id;
    private $title;
    private $content;
    private $priceHT;
    private $price;
    private $img;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Get the value of img
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Get the value of namtitlee
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }
 /**
     * Get the price
     */
    public function getPriceHT()
    {
        $price= $this->price;
        $price=number_format($price, 2, ',', '.');
        return $price." €";
    }
    /**
     * Get the price
     */
    public function getPrice()
    {
        $price= $this->price*1.2;
        $price=number_format($price, 2, ',', '.');
        return $price;
    }

    public function getExcerpt(int $length): string
    {
        return nl2br(htmlentities(TextController::excerpt($this->getContent(), $length)));
    }

    public function getUrl(): string
    {
        return \App\App::getInstance()
            ->getRouter()
            ->url('beer', [
                "id" => $this->getId(),
                "title" => $this->getTitle()
            ]);
    }
}
