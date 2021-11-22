<?php

namespace App\Models;

use App\Util\JsonSerializer;

class Collection extends JsonSerializer
{
    public $id;
    public $name;
    public $numberItems;
    public $communities;
}