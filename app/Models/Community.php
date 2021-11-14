<?php

namespace App\Models;

use App\Util\JsonSerializer;

class Community extends JsonSerializer
{
    public $id;
    public $name;
    public $countItems;
    public $collections;
}