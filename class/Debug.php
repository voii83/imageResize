<?php

class Debug
{
    public static function dd($value)
    {
        echo '<pre>';
        var_dump($value);
        echo '</pre>';
    }
}