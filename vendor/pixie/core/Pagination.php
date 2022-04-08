<?php


namespace pixie;


class Pagination
{
    private $currentPage;
    private $totalSumOfProducts;
    private $productsPerPage;
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

    public function __construct($currentPage, $totalSumOfProducts)
    {
        $this->currentPage = $currentPage;
        $this->totalSumOfProducts = $totalSumOfProducts;
        $this->totalSumOfPages;
    }
}