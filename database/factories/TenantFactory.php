<?php

use Faker\Generator as Faker;

$factory->define(\Betalabs\LaravelHelper\Models\Tenant::class,
    function (Faker $faker) {
        return [
            'name' => $faker->name,
            'email' => $faker->companyEmail,
        ];
    }
);
