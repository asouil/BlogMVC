<?php
namespace App\Model\Entity;

use Core\Model\Entity;

use Core\Controller\Helpers\TextController;

class BeerEntity extends Entity
{
    private $id;

    private $title;

    private $content;

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
     * Get the value of name
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
     * Get the value of created_at
     */
    public function getPrice()
    {
        return new $this->price;
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
                "title" => $this->getTitle(),
                "content" => getExcerpt($this->getContent(), 15)
            ]);
    }
}
