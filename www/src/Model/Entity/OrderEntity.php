<?php
namespace App\Model\Entity;

use Core\Model\Entity;

class CommandeEntity extends Entity
{

    private $id;
    private $id_user;
    private $priceHT;
    private $ids_product;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): string
    {
        return $this->id_user;
    }

    public function getPriceHT(): string
    {
        return $this->priceHT;
    }
    public function getPrice(): string
    {
        return $this->priceHT*1.2;
    }
    public function getIdsProduct(){
        return unserialiaze($this->ids_product);
    }
    public function getUrl(): string
    {
        return \App\App::getInstance()
            ->getRouter()
            ->url('orders', [
                "id" => $this->getId(),
                "price" => $this->getPrice()
            ]);
    }
}
