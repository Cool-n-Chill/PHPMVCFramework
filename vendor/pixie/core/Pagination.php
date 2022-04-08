<?php


namespace pixie;


class Pagination
{
    private $currentPageNumber;
    private $totalSumOfProducts;
    private $productsPerPage;
    private $totalSumOfPages;
    private $uri;
    private $links = [
        'back'          => '',
        'forward'       => '',
        'page2left'     => '',
        'page1left'     => '',
        'page2right'    => '',
        'page1right'    => '',
    ];

    public function __construct($currentPageNumber, $totalSumOfProducts)
    {
        $this->totalSumOfProducts = $totalSumOfProducts;
        $this->productsPerPage = App::$app->getProperty('pagination');
        $this->totalSumOfPages = (int)ceil($this->totalSumOfProducts / $this->productsPerPage);
        $this->currentPageNumber = $this->checkCurrentPageNumber($currentPageNumber);
        $this->uri = $this->getURLParams();
    }

    private function checkCurrentPageNumber($currentPageNumber)
    {
        if(!$currentPageNumber || $currentPageNumber < 1) $currentPageNumber = 1;
        if($currentPageNumber > $this->totalSumOfPages) $currentPageNumber = $this->totalSumOfPages;
        return $currentPageNumber;
    }

    private function getURLParams()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0] . '?';
        if(isset($url[1]) && $url[1] != ''){
            $params = explode('&', $url[1]);
            foreach($params as $param){
                if(!preg_match("#page=#", $param)) $uri .= "{$param}&amp;";
            }
        }
        return urldecode($uri);
    }

    public function getLinks()
    {
        if ($this->currentPageNumber > 1) {
            $this->links['back'] = "{$this->uri}page=" . ($this->currentPageNumber - 1);
        }
        if ($this->currentPageNumber < $this->totalSumOfPages) {
            $this->links['forward'] = "{$this->uri}page=" . ($this->currentPageNumber + 1);
        }
        if ($this->currentPageNumber - 2 > 0) {
            $this->links['page2left'] = "{$this->uri}page=" . ($this->currentPageNumber - 2);
        }
        if ($this->currentPageNumber - 1 > 0) {
            $this->links['page1left'] = "{$this->uri}page=" . ($this->currentPageNumber - 1);
        }
        if ($this->currentPageNumber + 2 <= $this->totalSumOfPages) {
            $this->links['page2right'] = "{$this->uri}page=" . ($this->currentPageNumber + 2);
        }
        if ($this->currentPageNumber + 1 <= $this->totalSumOfPages) {
            $this->links['page1right'] = "{$this->uri}page=" . ($this->currentPageNumber + 1);
        }
        return $this->links;
    }

    public function getCurrentPageNumber()
    {
        return $this->currentPageNumber;
    }

    public function getStartAndPerPage()
    {
        return [
            'start' => $this->getStart(),
            'perPage' => $this->getPerPage(),
        ];
    }

    private function getStart()
    {
        return ($this->currentPageNumber - 1) * $this->productsPerPage;
    }

    private function getPerPage()
    {
        return $this->productsPerPage;
    }
}