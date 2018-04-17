<?php

use Faker\Generator as Faker;

$factory->define(\Betalabs\LaravelHelper\Models\Company::class,
    function (Faker $faker) {
        return [
            'name' => $faker->name,
            'trading_name' => $faker->company,
            'email' => $faker->unique()->companyEmail,
            'cnpj' => '12345678910123',
        ];
    }
);
