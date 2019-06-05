<?php

/**
 * fichier qui génère la vue pour l'url /article/[i:id]
 * 
 */

$id = $params['id'];
$slug = $params['slug'];
$title = "article " . $slug;
?>



<?php 
$pdo = new PDO("mysql:host=".getenv('MYSQL_HOST').";dbname=".getenv('MYSQL_DATABASE'),
    getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'));
$sql='SELECT * FROM `post` WHERE `id` LIKE '.$id;
$statement=($pdo->prepare($sql));
$statement->execute(); 
//$statement->setFetchMode(PDO::FETCH_CLASS, App\Model\Post::class);
$article= $statement->fetch();//
    $titre= $article['name'];
    $contenu= nl2br(htmlspecialchars($article['content']));
    $timeof= (new DateTime($article['created_at']))->format('d/m/Y h:i');
?>

<html>
<head>
    <title><?= $titre; ?></title>
</head>
<body>
    <h1><?= $titre; ?></h1>
    <hr>
    <article><?= $contenu; ?></article>
    <hr>
    <span><?= $timeof; ?></span>

</body>

</html>

