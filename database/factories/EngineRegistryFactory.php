<?php

use Faker\Generator as Faker;

$factory->define(\Betalabs\LaravelHelper\Models\EngineRegistry::class,
    function (Faker $faker) {
        static $tenant;

        return [
            'tenant_id' => $tenant,
            'registry_id' => $faker->randomNumber(),
            'api_base_uri' => $faker->url,
            'api_access_token' => $faker->text
        ];
    }
);
