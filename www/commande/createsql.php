<?php
require_once '/var/www/vendor/autoload.php';
require_once 'donnees.php';
$pdo = new PDO('mysql:host=blog.mysql; dbname=blog',
                'userblog', 'blogpwd');

//creation tables
echo "[";
$etape = $pdo->exec("CREATE TABLE post(
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            slug VARCHAR(255) NOT NULL,
            content TEXT(650000) NOT NULL,
            created_at DATETIME NOT NULL,
            PRIMARY KEY(id)
        )");
echo "||";
$etape = $pdo->exec("CREATE TABLE category(
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            slug VARCHAR(255) NOT NULL,
            PRIMARY KEY(id)
        )");
echo "||";
echo "||";
$etape = $pdo->exec("CREATE TABLE post_category(
            post_id INT UNSIGNED NOT NULL,
            category_id INT UNSIGNED NOT NULL,
            PRIMARY KEY(post_id, category_id),
            CONSTRAINT fk_post
                FOREIGN KEY(post_id)
                REFERENCES post(id)
                ON DELETE CASCADE
                ON UPDATE RESTRICT,
            CONSTRAINT fk_category
                FOREIGN KEY(category_id)
                REFERENCES category(id)
                ON DELETE CASCADE
                ON UPDATE RESTRICT
        )");
echo "!!";
$etape = $pdo->exec("CREATE TABLE beer(
            id INT(11) NOT NULL AUTO_INCREMENT,
            title varchar(255) NOT NULL,
            img text NOT NULL,
            content longtext NOT NULL,
            price float NOT NULL,
            PRIMARY KEY(id)
            )");
echo "|&|";
$etape = $pdo->exec("CREATE TABLE orders(
            id INT(11) NOT NULL AUTO_INCREMENT,
            id_user INT(11) NOT NULL,
            ids_product longtext NOT NULL,
            priceTTC float NOT NULL,
            date_order datetime NOT NULL,
            PRIMARY KEY(id)
            )");
echo "|&&|";
$etape = $pdo->exec("CREATE TABLE users(
        id_user INT(11) NOT NULL AUTO_INCREMENT,
        lastname varchar(255) NOT NULL,
        firstname varchar(255) NOT NULL,
        address varchar(255) NOT NULL,
        zipCode varchar(255) NOT NULL,
        city varchar(255) NOT NULL,
        country varchar(255) NOT NULL,
        phone varchar(255) NOT NULL,
        mail varchar(255) NOT NULL,
        password varchar(255) NOT NULL,
        verify boolean,
        token varchar(12),
        PRIMARY KEY(id_user)
        )");

//vidage table
$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE users');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');
echo "||||||||||||";
$faker = Faker\Factory::create('fr_FR');
echo "||";
$posts = [];
$categories = [];
echo "||";
for ($i = 0; $i < 50; $i++) {
    $pdo->exec("INSERT INTO post SET
        name='{$faker->sentence()}',
        slug='{$faker->slug}',
        created_at ='{$faker->date} {$faker->time}',
        content='{$faker->paragraphs(rand(3, 15), true)}'");
    $posts[] = $pdo->lastInsertId();
    echo "|";
}

for ($i = 0; $i < 5; $i++) {
    $pdo->exec("INSERT INTO category SET
        name='{$faker->sentence(3, false)}',
        slug='{$faker->slug}'");
    $categories[] = $pdo->lastInsertId();
    echo "|";
}

foreach ($posts as $post) {
    $randomCategories = $faker->randomElements($categories, 2);
    foreach ($randomCategories as $category) {
        $pdo->exec("INSERT INTO post_category SET
                            post_id={$post},
                            category_id={$category}");
        echo "|";
    }
}
echo "||";
$statement = $pdo->prepare("INSERT INTO beer (title, img, content, price)
VALUES (:title, :img, :content, :price)");

foreach ($beerArray as $value) {
        $statement->execute([
        ':title'   => $value[0],
        ':img'     => $value[1],
        ':content' => $value[2],
        ':price'   => $value[3]
    ]);
}
    echo "||]
    ";

