<?php
namespace App\Model\Table;

use Core\Model\Table;
use App\Model\Entity\PostEntity;

class PostTable extends Table
{

    public function countById(?int $id = null)
    {
        if ($id) {
            return $this->query("SELECT COUNT(*) as nbrow FROM {$this->table} as p
            JOIN post_category as pc ON pc.post_id = p.id
            WHERE pc.category_id = {$id}", null, true);
        } else {
            return $this->query("SELECT COUNT(id) as nbrow FROM {$this->table}", null, true, null);
        }
    }

    public function allByLimit(int $limit, int $offset)
    {
        $beers = $this->query("SELECT * FROM {$this->table} LIMIT {$limit}  OFFSET {$offset}");

        $ids = array_map(function (BeerEntity $beer) {
            return $beer->getId();
        }, $beers);

        $beerById = [];
        foreach ($beer as $beer) {
            $beerById[$beer->getId()] = $beer;
        }
        return $beerById;
    }


}
