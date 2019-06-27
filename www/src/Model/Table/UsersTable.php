<?php
namespace App\Model\Table;
use Core\Model\Table;

class UsersTable extends Table
{
    

    public function userConnect($mail, $password, $isConnect=false) :?boolean
    {
        $sql = "SELECT * FROM users WHERE `mail`= ?";
        $pdo = getPDO();
            $statement = $pdo->prepare($sql);
            $statement->execute([htmlspecialchars($mail)]);
            $user = $statement->fetch();
        if(	$user && 
            password_verify(htmlspecialchars($password), $user['password']) && $user['verify']){
                    if($isConnect){
                        return true;
                        //exit();
                    }
                    if (session_status() != PHP_SESSION_ACTIVE){
                        session_start();
                    }
                    unset($user['password']);
                    $_SESSION['auth'] = $user;
                    //connecté
                    //header('location: index.php?p=profil');
                    exit();
            }else{
                if($isConnect){
                    return false;
                    //exit();
                }
                if (session_status() != PHP_SESSION_ACTIVE){
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
    function userin($verify=false){//:array|void|boolean
        if (session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
        // est pas defini et false
        if(!$_SESSION["auth"]){
            if($verify){
                return false;
            //exit();
            }
            //header('location: login.php');
            //exit();
        }
        return $_SESSION["auth"];
    }



    function login($user, $password, ?string $token=null){
        $pdo = getPDO();
        $req = $pdo->prepare('SELECT * FROM users WHERE token = ?');
        $req->execute($token);
        $user = $req->fetch();
        $req2 = $pdo->prepare('UPDATE users SET verify = ?, token = ? WHERE token = ?');
        $req2->execute([true, '', $token]);
        //return connection;
    }

    function create(UsersEntity $inser){
        $pdo=getPDO();
        $sql = "SELECT * FROM users WHERE `mail`= ?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$inser->getMail()]);
        $user = $statement->fetch();
        if(!$user){
            $req=$pdo->exec('INSERT INTO users SET
                    mail={$inser->mailgetMail()},
                    firstname={$inser->getFirstname()},
                    lastname={$inser->getLastName()},
                    address={$inser->getAddress()},
                    zipCode={$inser->getZipCode()},
                    city={$inser->getCity()},
                    country={$inser->getCountry()},
                    phone={$inser->getPhone()},
                    password={$inser->getPassword()}
                    token={$inser->getToken()');
            //envoi du token par mail avec MVC?
        }
        
    }

}