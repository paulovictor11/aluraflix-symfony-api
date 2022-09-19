<?php

namespace App\Interface\Helper;

use Symfony\Component\HttpFoundation\Request;

interface iDataExtractor
{
    public static function filterData(Request $request);
    public static function sortData(Request $request);
    public static function paginationData(Request $request);
}