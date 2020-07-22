<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name'  => $faker->lastName,
        'phone'      => $faker->e164PhoneNumber,
        'fb_link'    => 'facebook.com/me',
        'email'      => $faker->unique()->safeEmail,
        'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'password'   => Hash::make('password'),
        'active'     => $faker->boolean,
        'admin'      => $faker->boolean
    ];
});
