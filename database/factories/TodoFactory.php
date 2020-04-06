<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Todo;
use Faker\Generator as Faker;

$factory->define(\App\Models\Todo::class, function (Faker $faker) {
    return [
        'title' => $this->faker->sentence,
        'description' => $this->faker->sentence,
        'user_id' => 1
    ];
});
