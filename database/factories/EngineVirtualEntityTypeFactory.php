<?php

use Faker\Generator as Faker;

$factory->define(\Betalabs\LaravelHelper\Models\EngineVirtualEntityType::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
