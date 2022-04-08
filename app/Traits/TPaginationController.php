<?php


namespace app\Traits;


trait TPaginationController
{

    private $currentPageNumber;


    private function getCurrentPageNumber()
    {
        return @$_GET['page'] ? (int)$_GET['page'] : 1;
    }

}