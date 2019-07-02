<?php
namespace App\Model\Table;

use Core\Model\Table;

class UsersTable extends Table
{
    

    public function userConnect($mail, $password, $isConnect = false) :?boolean
    {
        $sql = "SELECT * FROM users WHERE `mail`= ?";
        $pdo = getPDO();
            $statement = $pdo->prepare($sql);
            $statement->execute([htmlspecialchars($mail)]);
            $user = $statement->fetch();
        if ($user &&
            password_verify(htmlspecialchars($password), $user['password']) && $user['verify']) {
            if ($isConnect) {
                return true;
                //exit();
            }
            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }
                    unset($user['password']);
                    $_SESSION['auth'] = $user;
                    //connecté
                    //header('location: index.php?p=profil');
                    exit();
        } else {
            if ($isConnect) {
                return false;
                //exit();
            }
            if (session_status() != PHP_SESSION_ACTIVE) {
                    session_start();
            }
            $_SESSION['auth'] = false;
            header('location: index.php?p=login');
            //TODO : err pas connecté
        }
    }

    /**
    * verifie que l'utilisateur est connecté
    * @return array|void
    */
    function userin($verify = false)
    {
//:array|void|boolean
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        // est pas defini et false
        if (!$_SESSION["auth"]) {
            if ($verify) {
                return false;
            //exit();
            }
            //header('location: login.php');
            //exit();
        }
        return $_SESSION["auth"];
    }



    function login($user, $password, ?string $token = null)
    {
        $pdo = getPDO();
        $req = $pdo->prepare('SELECT * FROM users WHERE token = ?');
        $req->execute($token);
        $user = $req->fetch();
        $req2 = $pdo->prepare('UPDATE users SET verify = ?, token = ? WHERE token = ?');
        $req2->execute([true, '', $token]);
        //return connection;
    }

    function create()
    {
        $user = query("SELECT * FROM users WHERE `mail`= ?",
            [
                htmlspecialchars($_POST["mail"])
            ]
        );
			if(!$user){
				$password = password_hash(htmlspecialchars($_POST["password"]), PASSWORD_BCRYPT);
				$token = setToken();
				$sql = "INSERT INTO `users` (`lastname`, `firstname`, `address`, `zipCode`, `city`, `country`, `phone`, `mail`, `password`, `token`) VALUES (
				 :lastname,				 
				 :firstname,
				 :address,
				 :zipCode, 
				 :city,
				 :country,
				 :phone,
				 :mail,
				 :password,
				 :token)
				 ";
				$statement = $pdo->prepare($sql);
				$result = $statement->execute([
					":lastname"		=> htmlspecialchars($_POST["lastname"]),
					":firstname"	=> htmlspecialchars($_POST["firstname"]),
					":address"		=> htmlspecialchars($_POST["address"]),
					":zipCode"		=> htmlspecialchars($_POST["zipCode"]),
					":city"			=> htmlspecialchars($_POST["city"]),
					":country"		=> htmlspecialchars($_POST["country"]),
					":phone"		=> htmlspecialchars($_POST["phone"]),
					":mail"			=> htmlspecialchars($_POST["mail"]),
					":password"		=> $password,
					":token"		=> $token
				]);
				if($result){
					$message =["html" => '<a href="http://bierecorrection.localhost/index.php?p=login&token='.$token.'">lala.com</a>',
					'text' => 'un texte'];
					envoiMail('Euuuhhhhh', $_POST['mail'], $message);
					header('location: index.php?p=login');
				}else{
					die("pas ok");
					//TODO : signaler erreur
				}
			}else{//fin verif user existe
				userConnect($_POST["mail"], $_POST["password"]);
			}
        }
    }
