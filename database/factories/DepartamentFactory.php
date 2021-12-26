<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Departament;
use Faker\Generator as Faker;

$factory->define(Departament::class, function (Faker $faker) {
    return [
        'name'        => $faker->word,
        'description' => $faker->text,
    ];
});
