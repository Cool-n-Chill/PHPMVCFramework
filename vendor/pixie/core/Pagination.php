<?php


namespace pixie;


class Pagination
{
    private $currentPage;
    private $productsPerPage;
    private $totalSumOfProducts;
    private $totalSumOfPages;
    private $uri;
    private $links = [
        'back'          => '',
        'forward'       => '',
        'startpage'     => '',
        'endpage'       => '',
        'page2left'     => '',
        'page1left'     => '',
        'page2right'    => '',
        'page1right'    => '',
    ];

    public function __construct($pageNumber, $productsPerPage)
    {
        $this->perPage = $perPage;
        $this->total = $total;
        $this->totalSumOfPages;
    }
}