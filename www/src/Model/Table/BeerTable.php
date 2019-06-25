<?php
namespace App\Model\Table;

use Core\Model\Table;
use App\Model\Entity\BeerEntity;

class BeerTable extends Table
{
    public function countById(?int $id = null)
    {
        if ($id) {
            return $this->query("SELECT COUNT(*) as nbrow FROM {$this->table}
            WHERE id = {$id}", null, true);
        } else {
            return $this->query("SELECT COUNT(id) as nbrow FROM {$this->table}", null, true, null);
        }
    }

    public function allInIdByLimit(int $limit, int $offset, int $id)
    {

        $beer = $this->query("SELECT * FROM {$this->table} WHERE id = {$id}
            LIMIT {$limit}  OFFSET {$offset}");
        return $beer;
        }

    public function allByLimit(int $limit, int $offset)
    {
        $beers = $this->query("SELECT * FROM {$this->table} LIMIT {$limit}  OFFSET {$offset}");

        $ids = array_map(function (BeerEntity $beer) {
            return $beer->getId();
        }, $beers);

        $beerById = [];
        foreach ($beers as $beer) {
            $beerById[$beer->getId()] = $beer;
        }
        return $beerById;
    }

}
