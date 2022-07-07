<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Stock;
use Faker\Generator as Faker;

$factory->define(Stock::class, function (Faker $faker) {

    return [
        'contract' => $faker->word,
        'renovation' => $faker->word,
        'laptop' => $faker->word,
        'printer' => $faker->word,
        'scanner' => $faker->word,
        'router' => $faker->word,
        'network_switch' => $faker->word,
        'led_tv' => $faker->word,
        'webcam' => $faker->word,
        'networking' => $faker->word,
        'furniture' => $faker->word,
        'smart_board' => $faker->word,
        'desktop' => $faker->word,
        'industrial_router' => $faker->word,
        'attendance_reader' => $faker->word,
        'digital_id_card' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
