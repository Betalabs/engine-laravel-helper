<?php

use Faker\Generator as Faker;

$factory->define(\Betalabs\LaravelHelper\Models\EngineCredential::class,
    function (Faker $faker) {
        return [
            'client_id' => $faker->randomNumber(),
            'client_secret' => $faker->password,
            'username' => $faker->unique()->email,
            'password' => $faker->password,
        ];
    }
);
