<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Reference;
use Faker\Generator as Faker;

$factory->define(Reference::class, function (Faker $faker) {

    return [
        'ref_type' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
