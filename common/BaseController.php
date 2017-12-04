<?php
/**
 * Created by PhpStorm.
 * User: Milos
 * Date: 11/19/2017
 * Time: 3:58 PM
 */

namespace common;


use dao\UserDao;
use model\User;

class BaseController
{
    protected function render(string $template, array $params = array()): string
    {
        extract($params);
        ob_start();
        require ROOT_TEMPLATE . $template;
        return ob_get_clean();
    }

    protected function getPagination(int $page, int $numberOfPages, int $maxNumberOfPages = 5): array
    {
        $pagesArray = array();
        if ($page > 2) {
            $pagesArray['Prva'] = 1;
        }

        if ($page > 1) {
            $pagesArray['Prethodna'] = $page - 1;
        }

        $midleNumberOfPages = (int)($maxNumberOfPages / 2);
        $minPageNumber = max($page - $midleNumberOfPages, 1);
        $maxPageNumber = min($page + $midleNumberOfPages, $numberOfPages);

        if (($maxPageNumber - $minPageNumber + 1) < min($numberOfPages, $maxNumberOfPages)) {
            $minPageNumber -= max(0, $page - $maxPageNumber + $midleNumberOfPages);
            $maxPageNumber = min($numberOfPages, $minPageNumber + $maxNumberOfPages - 1);
        }

        for ($i = $minPageNumber; $i <= $maxPageNumber; $i++) {
            $pagesArray['' . $i] = $i;
        }

        $pagesArray = $page < $numberOfPages ? $pagesArray + array('Sledeća' => $page + 1) : $pagesArray;
        $pagesArray = $page < $numberOfPages - 1 ? $pagesArray + array('Poslednja' => $numberOfPages) : $pagesArray;

        return $pagesArray;
    }

    protected function dd($v){
        var_dump($v);
        die();
    }


}