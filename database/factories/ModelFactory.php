<?php
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
        'allowed' => 0,
        'super_user' => 0,
    ];
});

$factory->define(App\Role::class, function ($faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(App\Contact::class, function ($faker) {
    return [
        'name' => $faker->name,
        'number' => '31636532389',
        'role_id' => 1
    ];
});

$factory->define(App\Group::class, function ($faker) {
    return [
        'name' => $faker->word
    ];
});