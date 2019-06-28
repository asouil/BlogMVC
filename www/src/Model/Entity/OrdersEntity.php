<?php
namespace App\Model\Entity;

use Core\Model\Entity;

class OrdersEntity extends Entity
{

    private $id;
    private $id_user;
    private $priceTTC;
    private $date_order;
    private $ids_product;



    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): string
    {
        return $this->id_user;
    }

    public function getPriceTTC(): string
    {
        return $this->priceTTC;
    }
    public function getPrice(): string
    {
        return $this->priceTTC/1.2;
    }
    public function getDate(){
        return $this->date_order;
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


    public function setIdUser($id_user){
        $this->id_user=$id_user;
    }

    public function setPrice($price){
        $this->price=$price;
    }
    public function setIdsProduct($prod){
        $this->ids_product=$prod;
    }
    public function setDate(){
        $this->date_order=new \Date();
    }
}