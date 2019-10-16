<?php

namespace etctech\OverallHelper\Mixins;

use Closure;
use Illuminate\Support\Facades\Route;

class RouteMixins
{
    public function resourceNaming(): Closure
    {
        return function ($prefix = "", $misc = null) {
            $result = [
                "names" => [
                    "index" => $prefix . ".index",
                    "show" => $prefix . ".show",
                    "create" => $prefix . ".create",
                    "store" => $prefix . ".store",
                    "edit" => $prefix . ".edit",
                    "update" => $prefix . ".update",
                    "destroy" => $prefix . ".destroy"
                ]
            ];

            if (!is_null($misc) && is_array($misc)) {
                $result = array_merge($result, $misc);
            }

            return $result;
        };
    }
}
