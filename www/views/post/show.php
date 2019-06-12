<?php
use App\Model\{Post, Connexion, Category};

/**
 * fichier qui génère la vue pour l'url /article/[i:id]
 * 
 */

$id = $params['id'];
$slug = $params['slug'];
$title = "article " . $slug;
?>

<?php 
$pdo = Connexion::connectPDO();

$sql='SELECT * FROM `post` WHERE `id` LIKE '.$id;
$statement=($pdo->prepare($sql));
$statement->execute(); 
$statement->setFetchMode(PDO::FETCH_CLASS, Post::class);
/** @var Post|false **/
$article= $statement->fetch();//

if(!$article){
    //on lève une exception
    throw new Exception ('Aucun article ne correspond à cet id!');
}
if($article->getSlug()!= $slug){
    $url= $router->url('post', ['id' => $id, 'slug'=> $article->getSlug()]);
    http_response_code(301);
    header('Location: '.$url);
    exit();
}
$query= $pdo->prepare('
    SELECT c.id, c.slug, c.name
    FROM post_category pc JOIN category c
    ON pc.category_id=c.id
    WHERE pc.post_id= :id ');
$query->execute([":id" => $article->getId()]);
$query->setFetchMode(PDO::FETCH_CLASS, Category::class);
$cats=$query->fetchAll();

foreach($cats as $cat){
    
    $category_url = $router->url('category', ['id' => $cat->getID(), 'slug' => $cat->getSlug()]);
    ?>
    <a href="<?= $category_url ?>"><?= '<li>'.$cat->getName().'</li>' ?></a><?php 
        
}

    $titre= $article->getName();
    
    $contenu= nl2br(htmlspecialchars($article->getContent()));
    $timeof= $article->getCreatedAt()->format('d/m/Y h:i');
?>

    <h1><?= $titre; ?></h1>
    <hr>
    <article><?= $contenu; ?></article>
    <hr>
    <span><?= $timeof; ?></span>



