<?php
namespace App\Controller;

use \Core\Controller\Controller;
use App\Controller\PaginatedQueryAppController;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->loadModel('orders');
        $this->loadModel('beer');
    }
    public function all()
    {

        $paginatedQuery = new PaginatedQueryAppController(
            $this->orders,
            $this->generateUrl('orders')
        );
        $title = "Commandes";
        if(!$paginatedQuery->getItems()){
            
            $this->render(
                "orders/all",
                [
                    "title" => $title,
                    "paginate" => $paginatedQuery->getNavHTML()
                ]
            );


        }
        else {
            $order = $paginatedQuery->getItems();
            $this->render(
                "orders/all",
                [
                    "title" => $title,
                    "orders" => $order,
                    "paginate" => $paginatedQuery->getNavHTML()
                ]
            );
        }
    }

    public function show(string $price, int $id)
    {
        $order = $this->order->find($id);

        if (!$order) {
            throw new Exception('Aucune categorie ne correspond à cet ID');
        }

        if ($order->getPrice() !== $price) {
            $url = $this->generateUrl('orders', ['id' => $id, 'price' => $order->getPrice()]);
            http_response_code(301);
            header('Location: ' . $url);
            exit();
        }

        $title = 'Commande : ' . $order->getId();

        $uri = $this->generateUrl("order", ["id" => $order->getId()]);

    }
}