<?php

    namespace YewTree\Website\Helpers;

    class Urlify
    {
        public static function urlify($string)
        {
            $string = preg_replace("/ & /", " and ", $string);
            $string = preg_replace("/[^\w\d\-\s]/", '', $string);
            $string = str_replace('_', '', $string);
            $string = preg_replace("/\s+/", "-", $string);
            $string = preg_replace("/-+/", "-", $string);
            return $string;
        }
    }