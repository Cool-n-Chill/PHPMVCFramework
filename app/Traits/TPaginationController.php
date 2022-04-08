<?php


namespace app\Traits;


trait TPaginationController
{

    private $currentPageNumber;


    private function getCurrentPageNumber()
    {
        return @$_GET['page'] ? (int)$_GET['page'] : 1;
    }

    private function getPaginationView($links, $currentPageNumber)
    {
        ob_start();
        require_once APP . '/views/Pagination/view.php';
        $paginationView = ob_get_contents();
        ob_end_clean();
        return $paginationView;
    }

}