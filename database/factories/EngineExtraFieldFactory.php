<?php

use Faker\Generator as Faker;

$factory->define(Betalabs\LaravelHelper\Models\EngineExtraField::class, function (Faker $faker) {
    return [
        'slug' => $faker->slug,
        'code' => $faker->randomNumber(),
        'label' => $faker->word,
        'form_code' => $faker->randomNumber(),
    ];
});
