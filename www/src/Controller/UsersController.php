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

    public function register()
    {

            $title = "Inscription";
            if(	isset($_POST["lastname"]) && !empty($_POST["lastname"]) &&
                isset($_POST["firstname"]) && !empty($_POST["firstname"]) &&
                isset($_POST["address"]) && !empty($_POST["address"]) &&
                isset($_POST["zipCode"]) && !empty($_POST["zipCode"]) &&
                isset($_POST["city"]) && !empty($_POST["city"]) &&
                isset($_POST["country"]) && !empty($_POST["country"]) &&
                isset($_POST["phone"]) && !empty($_POST["phone"]) &&
                isset($_POST["mail"]) && !empty($_POST["mail"]) &&
                isset($_POST["mailVerify"]) && !empty($_POST["mailVerify"]) &&
                isset($_POST["password"]) && !empty($_POST["password"]) &&
                isset($_POST["passwordVerify"]) && !empty($_POST["passwordVerify"])&&
                isset($_POST["robot"]) && empty($_POST["robot"])//protection robot
            ){
		
            if(
                ( 	filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL) && 
                    $_POST["mail"] == $_POST["mailVerify"]
                ) &&
                ( $_POST["password"] == $_POST["passwordVerify"])
            ){
                $methode=UsersTable\create();
                $this->render(
                    "users/register",
                    [
                        "title" => $title,
                        "methode" => $methode                    
                    ]
                );
            }
        }

        else {
            $this->render(
                "users/register",
                [
                    "title" => $title                  
                ]
            );
        }
    }

    public function show()
    {
        $user = $this->user->find($id);
        if (!$user) {
            throw new \Exception('Aucun utilisateur ne correspond à cet ID');
        }
        if ($user->getConnect()) {
            echo    '<h1>Profil</h1>';
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
