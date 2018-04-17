<?php

use Faker\Generator as Faker;

$factory->define(\Betalabs\LaravelHelper\Models\EngineCredential::class,
    function (Faker $faker) {
        return [
            'client_id' => $faker->randomNumber(),
            'client_secret' => $faker->text,
            'username' => $faker->userName,
            'password' => $faker->password,
        ];
    }
);
