<?php
use App\Model\ {
    Category,
    Post,
    Connexion
};
use App\PaginatedQuery;

$id = (int)$params['id'];
$slug = $params['slug'];
$pdo = Connexion::connectPDO();
$statement = $pdo->prepare("SELECT * FROM category WHERE id=?");
$statement->execute([$id]);
$statement->setFetchMode(PDO::FETCH_CLASS, Category::class);
/** @var Category|false */
$category = $statement->fetch();
if (!$category) {
    throw new Exception('Aucune categorie ne correspond à cet ID!');
}
if ($category->getSlug() !== $slug) {
    $url = $router->url(
        'category',
        ['id' => $id,
        'slug' => $category->getSlug()]
    );
    http_response_code(301);
    header('Location: ' . $url);
    exit();
}
$title = 'categorie : ' . $category->getName();

$url= $router->url('category', ['id' => $id, 'slug' => $slug]);

$paginatedQuery = new PaginatedQuery(
    "SELECT count(category_id) FROM post_category WHERE category_id = {$category->getId()}", 
    "SELECT p.* FROM post p JOIN post_category pc ON pc.post_id = p.id WHERE pc.category_id = {$category->getId()} ORDER BY created_at DESC",
    "App\Model\Post", $url, 12);

$posts= $paginatedQuery->getItems();

?>


<section class="row">
    <?php /** @var Category::class $post */
    foreach ($posts as $post) {
        require dirname(__dir__) . '/post/card.php';

    }
    ?>
</section>

<nav class="Page navigation">
    <ul class="pagination justify-content-center">

        <?php 
        $uri = $router->url("category", ["id" => $category->getId(), "slug" => $category->getSlug()]);
        $navhtml=$paginatedQuery->getNavHTML(); 
        
        echo $navhtml;?>
    </ul>
</nav>