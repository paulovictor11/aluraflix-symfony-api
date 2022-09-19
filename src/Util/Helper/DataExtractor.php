<?php

namespace App\Util\Helper;

use App\Interface\Helper\iDataExtractor;
use Symfony\Component\HttpFoundation\Request;

class DataExtractor implements iDataExtractor
{
    public static function filterData(Request $request)
    {
        [$filter] = self::requestData($request);

        return $filter;
    }

    public static function sortData(Request $request)
    {
        [, $sort] = self::requestData($request);

        return $sort;
    }

    public static function paginationData(Request $request): array
    {
        [,, $page, $perPage] = self::requestData($request);

        return [$page, $perPage];
    }

    private static function requestData(Request $request): array
    {
        $queryString = $request->query->all();

        $sort = array_key_exists('sort', $queryString) ? $queryString['sort'] : [];
        unset($queryString['sort']);

        $page = array_key_exists('page', $queryString) ? $queryString['page'] : 1;
        unset($queryString['page']);

        $perPage = array_key_exists('perPage', $queryString) ? $queryString['perPage'] : 5;
        unset($queryString['perPage']);

        return [$queryString, $sort, $page, $perPage];
    }
}
