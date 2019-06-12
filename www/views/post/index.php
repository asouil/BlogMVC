<?php

use App\Model\Post;
use App\Helpers\Text;
use App\Model\Connexion;


$pdo = Connexion::connectPDO();

$nbpost = $pdo->query('SELECT count(id) FROM post')->fetch()[0];
$perPage = 12;
$nbPage = ceil($nbpost / $perPage);

if ((int)$_GET["page"] > $nbPage) {
    header('location: /');
    exit();
}

if (isset($_GET["page"])) {
    $currentpage = (int)$_GET["page"];
} else {
    $currentpage = 1;
}
$offset = ($currentpage - 1) * $perPage;

$statement = $pdo->query("SELECT * FROM post 
                    ORDER BY id 
                    LIMIT {$perPage} 
                    OFFSET {$offset}");
$statement->setFetchMode(PDO::FETCH_CLASS, Post::class);
// Permet de récupérer une classe plutôt qu'un objet dans chaque post du tableau posts
$posts= $statement->fetchAll();

$title = 'Mon Super blog';
?>

<?php if (null !== $message) : ?>
    <div class="alert-message">
        <?= $message ?>
    </div>
<?php endif ?>
<section class="row">
    <?php foreach ($posts as $post) :
        require 'card.php';
    endforeach; ?>
</section>
<nav class="Page navigation">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $nbPage; $i++) : ?>
            <?php $class = $currentpage == $i ? " active" : ""; ?>
            <?php $uri = $i == 1 ? "" : "?page=" . $i; ?>
            <li class="page-item<?= $class ?>"><a class="page-link" href="/<?= $uri ?>"><?= $i ?></a></li>
        <?php endfor ?>
    </ul>
</nav>