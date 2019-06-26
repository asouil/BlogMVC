<?php
namespace App\Controller;

use \Core\Controller\Controller;
use App\Controller\PaginatedQueryAppController;

class BeerController extends Controller
{

    public function __construct()
    {
        $this->loadModel('beer');
    }
    public function all()
    {
        $paginatedQuery = new PaginatedQueryAppController(
            $this->beer,
            $this->generateUrl('beer')
        );

        $beers = $paginatedQuery->getItems();
        $title = "Les Bières";
        
        $this->render(
            "beer/all",
            [
                "title" => $title,
                "beers" => $beers,
                "paginate" => $paginatedQuery->getNavHTML()
            ]
        );
    }

    public function show(string $title, int $id)
    {

        $beer = $this->beer->find($id);
        
        if (!$beer) {
            throw new Exception('Aucune categorie ne correspond à cet ID');
        }

        if ($beer->getTitle() !== $title) {
            $url = $this->generateUrl('beer', ['id' => $id, 'title' => $beer->getTitle()]);
            http_response_code(301);
            header('Location: ' . $url);
            exit();
        }

        $title = 'Bière : ' . $beer->getTitle();

        $uri = $this->generateUrl("beer", ["id" => $beer->getId(), "title" => $beer->getTitle()]);

        $paginatedQuery = new PaginatedQueryAppController(
            $this->beer,
            $uri
        );

        $beerById = $paginatedQuery->getItemsInId($id);

        $this->render(
            "beer/show",
            [   
                "title" => $title,
                "img" =>$img,
                "content" => $content,
                "price" => $price, 
                "paginate" => $paginatedQuery->getNavHTML()
            ]
        );
    }
}
