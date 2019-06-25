<?php
namespace App;

class UserTable{

    function userConnect($mail, $password, $isConnect=false){//:boolean|void
        $sql = "SELECT * FROM users WHERE `mail`= ?";
        $pdo = getPDO();
            $statement = $pdo->prepare($sql);
            $statement->execute([htmlspecialchars($mail)]);
            $user = $statement->fetch();
            if(	$user && 
                password_verify(
                htmlspecialchars($password), $user['password']
            ) && $user['verify']){
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
                    header('location: index.php?p=profil');
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
    function userOnly($verify=false){//:array|void|boolean
        if (session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
        // est pas defini et false
        if(!$_SESSION["auth"]){
            if($verify){
                return false;
            //exit();
            }
            header('location: login.php');
            exit();
        }
        return $_SESSION["auth"];
    }

    function rand_pwd($nb_car = 10, $chaine ='azertyuiopqsdfghjklmwxcvbn0123456789') {
        $nb_lettre = strlen($chaine) -1;
        $generation = '';
        for($i=0; $i < $nb_car; $i++) {
            $pos = mt_rand(0, $nb_lettre);
            $car = $chaine[$pos];
            $generation .= $car;
        }
        return $generation;
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

}