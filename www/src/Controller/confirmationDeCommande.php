<?php
    $user = userOnly();

if (!isset($_GET['id'])) {
    header('location:'.uri("profil.php"));
    exit();
}
    $id = (int)$_GET['id']; //On "CAST"(convertit) $_GET['id'] en Integer

    $order=confirm($id);
if (!$order || $order['id_user'] != $user["id"]) {
    //On vérifie l'id de l'utilisateur Et l'existence de la commande
    header('location: '.uri("profil.php"));
    exit();
}
    $lines=confirm($id, $order);
    $priceTTC = 0;
foreach ($lines as $line) {
    $priceTTC += ($line["price"] * $line["qty"]) * $tva;
}
    //var_dump($beers);die;
if ((string)$priceTTC !== $order["priceTTC"]) { //On CAST $priceTTC en String pour                                                       comparaison avec $order["priceTTC"]
    header('location:'.uri('profil.php'));
    exit();
}
    include 'includes/header.php';
?>
<h1 class="titreduhaut">Confirmation de commande</h1>
<section id="commandSection">
    <table>
        <thead>
            <tr>
                <th>Nomination</th>
                <th>Prix HT</th>
                <th>Prix TTC</th>
                <th>Quantité</th>
                <th>Total TTC</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lines as $key => $line) : ?>
                <tr>
                    <td><?= $beers[$key]["title"] ?></td>
                    <td><?= number_format($line["price"], 2, ',', '.'); ?>€</td>
                    <td><?= number_format($line["price"]*$tva, 2, ',', '.');  ?>€</td>
                    <td><?= $line["qty"] ?></td>
                    <td><?= number_format($line["price"]*$line["qty"]*$tva, 2, ',', '.'); ?>€</td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td><strong>Total TTC</strong></td>
                <td></td>
                <td></td>
                <td></td>
                <td><strong><?= number_format($order["priceTTC"], 2, ',', '.'); ?>€</strong></td>
            </tr>
        </tbody>
    </table>
    <p style="text-align: center;">Celle-ci vous sera livrée au <?= $user["address"] ?> <?= $user["zipCode"] ?> <?= $user['city'] ?> sous deux jours</p>
        <p style="text-align:center;">
            <small>Si vous ne réglez pas sous 10 jours, le prix de votre commande sera majoré.(25%/jour de retard)</small>
        </p>
</section>



