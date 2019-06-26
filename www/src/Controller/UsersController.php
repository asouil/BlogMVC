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
            foreach($users as $user){
                if($user) {
                    $sqlparts = []; //:Array
                    $fields = []; //:Array
                    foreach($_POST as $key => $userInfo) {
                        if($key != 'robot' && $key != 'id_user') {
                            //On push "$key = ?" dans array $sqlparts
                            $sqlparts[] = $key.' = ?';
                            //On push la valeur de $userInfo dans $fields
                            $fields[] = $userInfo;
                        }
                    }
                    //On push l'id de l'utilisateur en dernier
                    $fields[] = $_POST['id_user'];
                    //On convertit le tableau $sqlparts en String en séparant ses cases par des virgules ',' 
                    $sqlparts = implode(',', $sqlparts);
                    //UPDATE users SET lastname = ?,firstname = ?,address = ?,zipCode = ?,city = ?,country = ?,phone = ? WHERE id_user = ?
                    $sql = "UPDATE users SET ".$sqlparts.' WHERE id_user = ?';
                    $req = $pdo->prepare($sql);
                    $req->execute($fields);
                }
            }   
                
            $title = "Connexion";
            $this->render(
                "user/login",
                [
                    "title" => $title,
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
            throw new \Exception('Aucun utilisateur ne correspond à cet ID');
        }
        if($user->getConnect()){
            echo 	'<h1>Profil</h1>';
                //tableau des commandes
            foreach ($orders as $order) {
                echo 'Vos commandes'.$this->order->getId();
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

