<?php
use App\Model\Post;
use App\Model\Connexion;
use App\Model\Category;
/**
 * fichier qui génère la vue pour l'url /categories
 * 
 */
$title = "Catégories";

$pdo=Connexion::connectPDO();
$sql='SELECT * FROM `category`';
$state=$pdo->query($sql);
$state->setFetchMode(PDO::FETCH_CLASS, Category::class);
$categories=$state->fetchAll();
echo '<ul>';

foreach($categories as $category):

?>

    <li><?= $category->getName(); ?></li>
<?php endforeach; ?>
</ul>
