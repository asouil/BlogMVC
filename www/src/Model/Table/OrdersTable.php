<?php
namespace App\Model\Table;

use Core\Model\Table;

class OrdersTable extends Table
{
    
    function confirm($id, ?string $order = null)
    {
        $pdo = getPDO();
        if ($order) {
            $sql = "SELECT * FROM orders WHERE id = ?";
            $statement = $pdo->prepare($sql);
            $statement->execute([$id]);
            return $statement->fetch();
        } else {
            $sql = "SELECT * FROM beer";
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $results= $statement->fetchAll();
            foreach ($results as $result) {
                $beers[$result["id"]] = $result;
            }
            return unserialize($order['ids_product']); //Rétablis le tableau à sa forme originale
        }
    }

    function affichebeer()
    {
        $sql = "SELECT * FROM `beer`";
        $pdo = getPDO();
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $beerArray = $statement->fetchAll();
    }
}
