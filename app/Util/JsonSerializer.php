<?php

namespace App\Util;

require __DIR__ . '/../../vendor/autoload.php';

abstract class JsonSerializer
{
    public static function Deserialize(string $jsonString)
    {
        $actualClass = get_called_class();
        $mapper = new \JsonMapper();
        $objecsArray = $mapper->mapArray(
            json_decode($jsonString),array(),$actualClass
        );
        return $objecsArray;
    }
}