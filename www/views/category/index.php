<?php
use App\Model\Post;
use App\Model\Connexion;
use App\Model\Category;
use App\Helpers\Text;
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

foreach($categories as $category): ?>

    <article class="col-12 col-md-3 mb-4 d-flex align-items-stretch">
        <a href="<?= $router->url("category", ["id" => $category->getId(), "slug" => $category->getSlug()]); ?>"><?= $category->getName(); ?></a>
    </article>
    
<?php endforeach; ?>