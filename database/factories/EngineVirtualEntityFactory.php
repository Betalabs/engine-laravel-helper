<?php

use Faker\Generator as Faker;

$factory->define(\Betalabs\LaravelHelper\Models\EngineVirtualEntity::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber(),
        'type_id' => function () {
            return factory(\Betalabs\LaravelHelper\Models\EngineVirtualEntityType::class)->create()->id;
        }
    ];
});
