<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use \Spatie\Tags\HasTags;
    protected $guarded = [];
}
