<?php
namespace App\Controller;

use \Core\Controller\Controller;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->loadModel('users');
        //$this->loadModel('order');
    }

    public function all()
    {
        
        $paginatedQuery = new PaginatedQueryAppController(
            $this->users,
            $this->generateUrl('users')
        );
        
        //on va voir pour définir sur quelle page on envoi notre utilisateur avant de le diriger sur la page...
        // là je me renseigne sur les variables qu'on peut envoyer à twig
        if($users){
            $title = "Connexion";
            $this->render(
                "user/login",
                [
                    "title" => $title,
                    "users" => $users,
                    "paginate" => $paginatedQuery->getNavHTML()
                ]
            );
        }
        else {
            $title = "Inscription";
            $this->render(
                "user/register",
                [
                    "title" => $title,
                    "paginate" => $paginatedQuery->getNavHTML()
                ]
            );
        }




    }

    public function show(){
        $user = $this->user->find($id);
        if (!$user) {
            throw new \Exception('Aucun article ne correspond à cet ID');
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

        /*$order = $this->order->allInId($post->getId());
        $title = "article : " . $post->getName();
        $this->render(
            "post/show",
            [
                "title" => $title,
                "order" => $order,
                "post" => $post
            ]
        );*/
    }
}