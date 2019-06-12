<?php
define("MTS", microtime(true));

$basePath = dirname(__dir__) . DIRECTORY_SEPARATOR;

require_once $basePath . 'vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$numpage= \App\URL::getPositiveInt('page');
if ($numpage!==null) {
    // url /categories?page=1&param2=pomme
    if ($numpage == 1) {
        $uri = explode('?', $_SERVER["REQUEST_URI"])[0];
        $get = $_GET;
        unset($get["page"]);
        $query = http_build_query($get);
        if (!empty($query)) {
            $uri = $uri . '?' . $query;
        }
        http_response_code(301);
        header('location: ' . $uri);
        exit();
    } 
}

$router = new App\Router($basePath . 'views');

$router->get('/', 'post/index', 'home')
    ->get('/categories', 'category/index', 'categories')
    ->get('/category/[*:slug]-[i:id]', 'category/show', 'category')
    ->get('/article/[*:slug]-[i:id]', 'post/show', 'post')
    ->get('/contact', 'post/contact', 'contact')
    ->run();
