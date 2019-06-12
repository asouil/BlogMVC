<?php

namespace App;
use App\Model\Connexion;


    class PaginatedQuery {

        private $query;
        private $queryCount;
        private $url;
        private $classMapping;
        private $pdo;
        private $perpage;

            //on ne type pas les propriétés
        public function __construct(string $queryCount, string $query, string $classMapping, string $url, int $perpage=12){
            $this->queryCount = $queryCount;
            $this->query=$query;
            $this->classMapping= $classMapping;
            $this->url=$url;
            $this->perpage=$perpage;
            $this->pdo=Connexion::connectPDO();
            
        }

        public function getPages():Int
        {
            $nbpost=$this->pdo->query($this->queryCount)->fetch()[0];
            $perpage=$this->perpage;
            $nbpages = ceil($nbpost / $perpage);
            return intval($nbpages);
        }

        public function getItems():array
        {
            $nbPage = $this->getPages();
            if ((int)$_GET["page"] > $nbPage) {
                throw new \Exception('pas de pages');
            }
            if (isset($_GET["page"])) {
                $currentpage = (int)$_GET["page"];
            } else {
                $currentpage = 1;
            }
            $offset = ($currentpage - 1) * $perPage;
            $statement=$this->pdo->query("{$this->query} LIMIT {$this->perpage} OFFSET {$offset}");
            $statement->setFetchMode(\PDO::FETCH_CLASS, $this->classMapping);
            return $statement->fetchAll();
        }

        public function getNav(): array
        {
            $nav=[];
            $uri=$this->url;
            $nbpage=$this->getPages();
            $nbpage=($nbpage);
            for ($i = 1; $i <= $nbpage; $i++) :
                if($i==1) {
                    $nav[$i] = $uri;
                }else{
                    $nav[$i]= $uri."?page=" . $i;
                }
            endfor;
            return $nav;            
        }

        public function getNavHTML()
        {
            $html=$this->getNav();
            $navhtml="";
            for ($i = 1; $i <= count($html); $i++) :
                $navhtml.= 
                "<li>
                    <a class='page-link' href='".$html[$i]."' />".$i."</a>
                </li>";
            endfor;
            return $navhtml;
        }
    }