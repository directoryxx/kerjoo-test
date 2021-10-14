<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'submission_date' => $faker->dateTimeBetween('now', '+1 year'),
        'reason' => $faker->realText(100),
    ];
});
