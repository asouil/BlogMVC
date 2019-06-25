<?php
namespace App\Controller;

use \Core\Controller\Controller;
use App\Controller\PaginatedQueryAppController;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->loadModel('order');
        $this->loadModel('post');
    }
    public function all()
    {

        $paginatedQuery = new PaginatedQueryAppController(
            $this->order,
            $this->generateUrl('order')
        );

        $categories = $paginatedQuery->getItems();
        $title = "Commandes";

        $this->render(
            "order/all",
            [
                "title" => $title,
                "categories" => $categories,
                "paginate" => $paginatedQuery->getNavHTML()
            ]
        );
    }

    public function show(string $slug, int $id)
    {
        $order = $this->order->find($id);

        if (!$order) {
            throw new Exception('Aucune categorie ne correspond à cet ID');
        }

        if ($order->getSlug() !== $slug) {
            $url = $this->generateUrl('order', ['id' => $id, 'slug' => $order->getSlug()]);
            http_response_code(301);
            header('Location: ' . $url);
            exit();
        }

        $title = 'categorie : ' . $order->getName();

        $uri = $this->generateUrl("order", ["id" => $order->getId(), "slug" => $order->getSlug()]);

        $paginatedQuery = new PaginatedQueryAppController(
            $this->post,
            $uri
        );

        $postById = $paginatedQuery->getItemsInId($id);

        $this->render(
            "order/show",
            [
                "title" => $title,
                "posts" => $postById,
                "paginate" => $paginatedQuery->getNavHTML()
            ]
        );
    }
}