<?php
namespace App\Controller;

use \Core\Controller\Controller;
use App\Controller\PaginatedQueryAppController;
use App\Model\Entity\OrdersEntity;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->loadModel('users');
        $this->loadModel('orders');
        $this->loadModel('beer');
    }
    public function all()
    {
        if ($user!==null) {
            $order = new OrdersEntity();
                $order->setIdUser($user->getId());
                $order->setPrice($price);
                $order->setIdsProduct($prod);
                $order->setDate();
                
                $attrib = [
                    "id_user"   => $order->getUser(),
                    "product"   => $order->getIdsProduct(),
                    "priceTTC"  => $order->getPrice(),
                    "date"      => $order->getDate()
                ];
                $result = $this->orders->insert($attrib);
                exit();
        } else {
            $title = 'Commander : ' . $order;
            $paginatedQuery = new PaginatedQueryAppController(
                $this->orders,
                $this->generateUrl('orders')
            );
            $this->render(
                "orders/all",
                [
                "title" => $title,
                "paginate" => $paginatedQuery->getNavHTML()
                ]
            );
        }
    }

    public function show(string $price, int $id)
    {
        $order = $this->beers->find($id);
        $user = $this->users;
        $paginatedQuery = new PaginatedQueryAppController(
            $this->orders,
            $this->generateUrl('orders')
        );
        if ($order) {
            if ($order->getPrice() !== $price) {
                $url = $this->generateUrl('orders', ['id' => $id, 'price' => $order->getPrice()]);
                http_response_code(301);
                header('Location: ' . $url);
                exit();
            }
            $title = 'Commandess : ' . $order->getId();
            $uri = $this->generateUrl("orders", ["id" => $order->getId()]);
        } else {
            $uri = $this->generateUrl("orders");
            $title = 'Commande n° : ' . $order->getId();
        }
        $this->render(
            "orders/all",
            [
                "title" => $title,
                "paginate" => $paginatedQuery->getNavHTML()
            ]
        );
    }

    public function purchase($envoi = null)
    {
        $paginatedQuery = new PaginatedQueryAppController(
            $this->orders,
            $this->generateUrl('orders')
        );
        $title = "Commande :";
            
            $this->render(
                "orders/all",
                [
                    "title" => $title,
                    "paginate" => $paginatedQuery->getNavHTML()
                ]
            );
    }
}
