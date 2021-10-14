<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Permit;
use Faker\Generator as Faker;

$factory->define(Permit::class, function (Faker $faker) {
    return [
        'submission_date' => $faker->date,
        'reason' => $faker->realText(rand(20,200)),
    ];
});
