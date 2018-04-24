<?php

use Faker\Generator as Faker;

$factory->define(\Betalabs\LaravelHelper\Models\EngineVirtualEntity::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber(),
        'type' => $faker->randomElement([
            \Betalabs\LaravelHelper\Models\Enums\EngineVirtualEntity::PRODUCT,
            \Betalabs\LaravelHelper\Models\Enums\EngineVirtualEntity::SHIPPING_COMPANY
        ]),
    ];
});
