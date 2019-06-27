<?php
namespace App\Controller;

use \Core\Controller\Controller;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->loadModel('users');
        $this->loadModel('orders'); 
    }
    public function all()
    {
        
        $paginatedQuery = new PaginatedQueryAppController(
            $this->users,
            $this->generateUrl('users')
        );

                
            $title = "Profil";
            $this->render(
                "users/all",
                [
                    "title" => $title,
                    "paginate" => $paginatedQuery->getNavHTML()
                ]
            );
        
    }
    public function login()
    {
        
        $paginatedQuery = new PaginatedQueryAppController(
            $this->users,
            $this->generateUrl('users')
        );

            $title = "Connexion";
            $this->render(
                "users/login",
                [
                    "title" => $title,
                    "paginate" => $paginatedQuery->getNavHTML(),
                ]
            );
        
    }

    public function register(){

            $title = "Inscription";
            $this->render(
                "users/register",
                [
                    "title" => $title,
                ]);
        
    }

    public function show(){
        $user = $this->user->find($id);
        if (!$user) {
            throw new \Exception('Aucun utilisateur ne correspond à cet ID');
        }
        if($user->getConnect()){
            echo 	'<h1>Profil</h1>';
                //tableau des commandes
            foreach ($orders as $order) {
                echo 'Vos commandes'.$this->orders->getId();
            }
            if ($user->getId() !== $user[$id]) {
                $url = $this->generateUrl('user', [
                        'id' => $id, 
                        'user' => $user->getToken()
                    ]);
                http_response_code(301);
                header('Location: ' . $url);
                exit();
            }
            $this->render(
                "user/profil",
                [
                    "title" => $title,
                    "user" => $user,
                    "paginate" => $paginatedQuery->getNavHTML()
                ]
            );
        }
    }
}

