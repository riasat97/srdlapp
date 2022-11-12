<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Notice;
use Faker\Generator as Faker;

$factory->define(Notice::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'file1' => $faker->word,
        'file1_path' => $faker->word,
        'published_at' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
