<?php 
use Core\Controller\Helpers\InjectHTML;

?>

<h1><?= $page ?></h1>

<form method="POST" name="<?= $page ?>" action="">

<?php
	if ($page == 'login'){
		if($_GET['token'] && $_GET['token'] !== '') {
			$pdo=getPDO();
			$req = $pdo->prepare('SELECT * FROM users WHERE token = ?');
			$req->execute($_GET['token']);
			$user = $req->fetch();
			$req2 = $pdo->prepare('UPDATE users SET verify = ?, token = ? WHERE token = ?');
			$req2->execute([true, '', $_GET['token']]);
			if($user) {
				setFlashMessages('info', 'Votre compte est bien activé');
			}
		}
		echo   input("mail", "votre courriel","", "email");
		echo   input("password", "votre mot de passe","", "password")
		.'<a href="index.php?p=reset">Mot de passe oublié</a>';	

	}else if ($page == 'register'){

		echo    input("mail", "votre courriel","", "email");
				input("mailVerify", "vérification de votre courriel","", "email").
				input("lastname", "votre nom","").
				input("firstname", "votre prénom","").
				input("address", "votre adresse","").
				input("zipCode", "votre code postal","").
				input("city", "votre ville","").
				input("country", "votre pays","").
				input("phone", "votre numéro de portable","", "tel").
				input("password", "votre mot de passe","", "password").
				input("passwordVerify", "confirmez votre mot de passe","", "password")
				.'<a href="index.php?p=reset">Mot de passe oublié</a>';
	}else if ($page == 'profil'){

		echo	'<hr /><form method="POST" name="inscription" action="">'.
				input("lastname", "votre nom",$user["lastname"]).
				input("firstname", "votre prénom",$user["firstname"]).
				input("address", "votre adresse",$user["address"]).
				input("zipCode", "votre code postal",$user["zipCode"]).
				input("city", "votre ville",$user["city"]).
				input("country", "votre pays",$user["country"]).
				input("phone", "votre numéro de portable",$user["phone"], "tel").
				"votre courriel : ".$user["mail"].
				input("robot", "","", "hidden").
				input("id_user", "",$user["id_user"], "hidden").
				"<button type=\"submit\">Envoyez</button>".
				'</form><hr />';

		echo 	'<form method="POST" name="inscription" action="">'.
				input("passwordOld", "votre ancien mot de passe","", "password").
				input("password", "votre mot de passe","", "password").
				input("passwordVerify", "confirmez votre mot de passe","", "password").
				"<button type=\"submit\">Envoyez</button>".
				'</form><hr />';
	}

	echo input("robot", "","", "hidden");
?>

    <button type="submit">Envoyez</button>
</form>


