<?php
namespace App\Model\Entity;

use Core\Model\Entity;

use Core\Controller\Helpers\TextController;

class UsersEntity extends Entity
{
    private $id_user;
    private $lastname;
    private $firstname;
    private $address;
    private $zipCode;
    private $city;
    private $country;
    private $phone;
    private $mail;
    private $_password;
    private $token;

    private $connect;
    private $verify;

    private $categories = [];

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id_user;
    }

    /**
     * Get the value of name
     */
    public function getLastName()
    {
        return $this->lastname;
    }
    public function getFirstName()
    {
        return $this->firstname;
    }
    /**
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }
    public function getZipCode()
    {
        return $this->zipCode;
    }
    public function getCity()
    {
        return $this->city;
    }
    public function getCountry()
    {
        return $this->country;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getMail()
    {
        return $this->mail;
    }
    /**
     * Get the value of created_at
     * @return \DateTime
     */
    public function getToken()
    {
        return $this->token;
    }

    public function setToken($nb_car = 10, $chaine ='azertyuiopqsdfghjklmwxcvbn0123456789') {
        $nb_lettre = strlen($chaine) -1;
        $generation = '';
        for($i=0; $i < $nb_car; $i++) {
            $pos = mt_rand(0, $nb_lettre);
            $car = $chaine[$pos];
            $generation .= $car;
        }
        return $this->token=$generation;
    }

    protected function getVerify(){
        return $this->verify;
    }
    public function setVerify($token){
        if($this->getToken()==$token){
            return $verify=true;
        }
        return $verify=false;
    }

    public function getConnect(){
        return $this->connect;
    }
    public function setConnect(){
        if($this->verify){
            return $this->connect=true;
        }
        else{
            return $this->connect=true;
        }
    }

    public function getUrl(): string
    {
        return \App\App::getInstance()
            ->getRouter()
            ->url('users', [
                $this->getToken()
            ]);
    }
}
