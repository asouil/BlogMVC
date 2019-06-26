<?php
$basePath = dirname(__dir__) . DIRECTORY_SEPARATOR;

require_once $basePath . 'vendor/autoload.php';

$app = App\App::getInstance();
$app->setStartTime();
$app::load();

$app->getRouter($basePath)
    ->get('/',  'Beer#all', 'beer')
    ->get('/users', 'Users#all', 'users')
    ->get('/users/login', 'Users#login', 'login')
    ->get('/users/register', 'Users#register', 'register')
    ->get('/categories', 'Category#all', 'categories')
    ->get('/category/[*:slug]-[i:id]', 'Category#show', 'category')
    ->get('/blog', 'Post#all', 'blog')
    ->get('/article/[*:slug]-[i:id]', 'Post#show', 'post')
    ->get('/order', 'order#all', 'order')
    ->get('/cautions', 'mentions.php', 'mentions' )
    ->get('/test', 'Twig#index', 'test')
    ->run();
