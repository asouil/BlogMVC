<?php
namespace App\Model\Entity;

use Core\Model\Entity;

use Core\Controller\Helpers\TextController;

class UserEntity extends Entity
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

    public function getExcerpt(int $length): string
    {
        return nl2br(htmlentities(TextController::excerpt($this->getContent(), $length)));
    }

    public function getUrl(): string
    {
        return \App\App::getInstance()
            ->getRouter()
            ->url('user', [
                "" => $this->getFirstName(),
                "" => $this->getLastName()
            ]);
    }
}
