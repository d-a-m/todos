<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Word;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/


$categoriesIds = \App\Models\Category::pluck('id')->toArray();
$categoriesIds = array_slice($categoriesIds, 0, 4);

$words = factory(Word::class, 20)
    ->create()
    ->each(function ($word) use ($categoriesIds) {
        $word->categories()->attach($categoriesIds);;
    });