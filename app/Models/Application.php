<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use \Spatie\Tags\HasTags;
    protected $guarded = [];
}
