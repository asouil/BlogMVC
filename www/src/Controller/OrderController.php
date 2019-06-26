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

        $order = $paginatedQuery->getItems();
        $title = "Commandes";

        $this->render(
            "order/all",
            [
                "title" => $title,
                "order" => $order,
                "paginate" => $paginatedQuery->getNavHTML()
            ]
        );
    }

    public function show(string $price, int $id)
    {
        $order = $this->order->find($id);

        if (!$order) {
            throw new Exception('Aucune categorie ne correspond à cet ID');
        }

        if ($order->getPrice() !== $price) {
            $url = $this->generateUrl('order', ['id' => $id, 'price' => $order->getPrice()]);
            http_response_code(301);
            header('Location: ' . $url);
            exit();
        }

        $title = 'Commande : ' . $order->getId();

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