<?php

use Faker\Generator as Faker;

$factory->define(\Betalabs\LaravelHelper\Models\AppConfiguration::class,
    function (Faker $faker) {
        return [
            'engine_app_registry_id' => $faker->randomNumber(),
            'engine_api_base_uri' => $faker->url,
        ];
    }
);
