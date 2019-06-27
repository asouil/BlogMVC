<?php
namespace App\Model\Table;
use Core\Model\Table;

class OrdersTable extends Table
{
    
	function calcPrice(){

		$sql = "SELECT * FROM `beer`";
		$pdo = getPDO();
		$statement = $pdo->prepare($sql);
		$statement->execute(); 

		$beers = $statement->fetchAll();

		$beerTotal = [];
		foreach ($beers as $key => $beer) {
			$beerTotal[$beer['id']]= $beer;
		}

		$priceTTC = 0;
		foreach($_POST['qty'] as $key => $valueQty) { //on boucle sur le tableau $_POST["qty"]
			if($valueQty > 0) {
				$price = $beerTotal[$key]['price']; 
				$qty[$key] = ['qty' => $valueQty, "price"=>$price];
				$priceTTC += $valueQty * $price * $tva;
			}
		}
		$serialCommande = serialize($qty); //On convertit le tableau $qty en String pour l'utiliser												l'envoyer en bdd plus tard.

		$orders = [":id_user"=>(int)$user['id_user'], ":ids_product"=>$serialCommande, ":priceTTC"=>$priceTTC];

		$sql = "INSERT INTO `orders` (`id_user`,`ids_product`,`priceTTC`) VALUES (:id_user, :ids_product, :priceTTC)";

		$statement = $pdo->prepare($sql);
		$statement->execute($orders);

		$id = $pdo->lastInsertId(); //On recupère l'id de la dernière insertion en bdd

		header('location: '.uri("confirmationDeCommande.php?id=".$id));
		exit();
	}
	function confirm($id, ?string $order=null){
		$pdo = getPDO();
		if($order){
			$sql = "SELECT * FROM orders WHERE id = ?";
			$statement = $pdo->prepare($sql);
			$statement->execute([$id]);
			return $statement->fetch();
		}
		else {
			$sql = "SELECT * FROM beer";
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$results= $statement->fetchAll();
			foreach($results as $result) {
				$beers[$result["id"]] = $result;
			}
			return unserialize($order['ids_product']); //Rétablis le tableau à sa forme originale
		}
	}

	function affichebeer(){
		$sql = "SELECT * FROM `beer`";
		$pdo = getPDO();
		$statement = $pdo->prepare($sql);
		$statement->execute(); 

		$beerArray = $statement->fetchAll();
	}
}