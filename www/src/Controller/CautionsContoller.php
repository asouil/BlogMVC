<?php
namespace App\Controller;

use \Core\Controller\Controller;
use App\Controller\PaginatedQueryAppController;

class CautionsController extends Controller
{

    public function all()
    {

        $title = "Mentions Légales";

        $this->render(
            "cautions/mentions",
            [
                "title" => $title,
            ]
        );
    }

}
