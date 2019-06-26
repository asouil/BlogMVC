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
            if(!empty($_POST)){
                //verif pour modif mdp
                if(	isset($_POST["passwordOld"]) && !empty($_POST["passwordOld"]) &&
                    isset($_POST["password"]) && !empty($_POST["password"]) &&
                    isset($_POST["passwordVerify"]) && !empty($_POST["passwordVerify"]) &&
                    isset($_POST["robot"]) && empty($_POST["robot"])//protection robot
                ){
                    if(userConnect($user["mail"], $_POST["passwordOld"], true)){
                        if ($_POST["password"] == $_POST["passwordVerify"]) {
                            $password = password_hash(htmlspecialchars($_POST["password"]), PASSWORD_BCRYPT);
                            $sql = "UPDATE `users` SET `password`=:password WHERE `id_user`=:id_user";
                            $pdo = getDB($dbuser, $dbpassword, $dbhost,$dbname);
                            $statement = $pdo->prepare($sql);
                            $statement->execute([
                                ":password" => $password,
                                ":id_user" 	=> $user["id_user"]
                            ]);
                            //message modif ok
                            $_SESSION['success'] = 'Votre mot de passe a bien été modifié';
                        }else{
                            //mdp correspondent pas
                            $_SESSION['error'] = 'Les deux mots de passes ne correspondent pas.';
                        }
                    }else{
                        //erreur 
                        $_SESSION['error'] = 'Mot de passe incorrect';
                    }
                }
                elseif(isset($_POST["lastname"]) && !empty($_POST["lastname"]) &&
                    isset($_POST["firstname"]) && !empty($_POST["firstname"]) &&
                    isset($_POST["address"]) && !empty($_POST["address"]) &&
                    isset($_POST["robot"]) && empty($_POST["robot"])){

                        if(isset($_POST["lastname"]) && !empty($_POST["lastname"]) &&
                            isset($_POST["firstname"]) && !empty($_POST["firstname"]) &&
                            isset($_POST["address"]) && !empty($_POST["address"]) &&
                            isset($_POST["zipCode"]) && !empty($_POST["zipCode"]) &&
                            isset($_POST["city"]) && !empty($_POST["city"]) &&
                            isset($_POST["country"]) && !empty($_POST["country"]) &&
                            isset($_POST["phone"]) && !empty($_POST["phone"]) &&
                            isset($_POST["robot"]) && empty($_POST["robot"])
                        ){
                            $sql = 'SELECT * FROM users WHERE id_user = ?';
                            $pdo = getDB($dbuser, $dbpassword, $dbhost,$dbname);
                            $statement = $pdo->prepare($sql);
                            $statement->execute([htmlspecialchars($_POST['id_user'])]);
                            $user = $statement->fetch();

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
                            
                            }else{//fin verif user existe
                                userConnect($_POST["mail"], $_POST["password"]);
                            }
                        }
                }
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
            throw new \Exception('Aucun utilisateur ne correspond à cet ID');
        }
        if($user->getConnect()){
                echo 	'<h1>Profil</h1>';
                //tableau des commandes
                foreach ($orders as $order) {
                    echo '<a href="'.uri("confirmationDeCommande.php?id=").$order["id"].'">commande n°'.$order["id"].'- '.number_format($order["priceTTC"], 2, ',' ,'.').'€ </a><br />';
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

