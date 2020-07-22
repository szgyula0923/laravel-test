<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'phone'   => $faker->e164PhoneNumber,
        'email'   => $faker->unique()->safeEmail,
        'name'    => $faker->name,
        'message' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'website' => $faker->domainName,
        'user_id' => function(){
            return App\User::all()->random();
        }
    ];
});
