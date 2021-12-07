<?php

namespace app\libraries;

class Pagination
{
    const LIMIT_ROW = 2;
    const ROOT_PATH = 'index.php';

    // tao ham - tao link phan trang cho cac module
    public static function createLink($data = [])
    {
        /*
            [
                'c' => 'brand',
                'm' => 'index',
                'page' => '{page}',
                's' => '{$key}' // ko bat buoc
            ]
            // index.php?c=brand&m=index&page=1&s=
        */
        $strLinks = '';
        foreach ($data as $key => $value) {
            $strLinks .= ($strLinks === '') ? "?{$key}={$value}" : "&{$key}={$value}";
        }
        return self::ROOT_PATH.$strLinks;
    }

    public static function paging($link, $totalItem, $page = 1, $keyword = '', $limit = self::LIMIT_ROW)
    {
        // $link : dc tao ra boi ham createLink
        // di tinh tong so trang : total page
        // $totalItem : tong so dong du lieu (record) tra ve trong database
        $totalPage = ceil($totalItem/$limit); // ceil : lam tron len
        // tinh lai page: current page
        if($page < 1){
            $page = 1;
        } elseif ($page > $totalPage) {
            $page = $totalPage;
        }
        // tinh start trong tu khoa limit cua mysql
        // trong mysql : limit start,limtRows
        // start : 0
        // page : 1
        $start = ($page - 1) * $limit;

        // dung template phan trang
        $htmlPaginate = '';
        $htmlPaginate .= '<nav>';
        $htmlPaginate .= '<ul class="pagination">';
        // xu ly button Previous : quay ve trang truoc do
        if($page > 1){
            $htmlPaginate .= '<li class="page-item">';
            $htmlPaginate .= '<a href="'.str_replace('{page}', $page-1, $link).'" class="page-link">Previous</a>';
            $htmlPaginate .= '</li>';
        }

        // cac trang o giua

        // button next: di sang trang ke tiep

        $htmlPaginate .= '</ul>';
        $htmlPaginate .= '</nav>';
    }
}