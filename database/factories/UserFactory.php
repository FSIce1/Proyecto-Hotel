<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use proyecto_inicial\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use proyecto_inicial\Models\Cliente\ClienteModel;

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
        'name' => $faker->unique()->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});


$factory->define(ClienteModel::class, function (Faker $faker) {
    return [
        'nombre_cliente' => $faker->unique()->name,
        'tipo_cliente' => $faker->randomLetter,
        'n_documento_cliente' => $faker->unique()->ean8,
        'n_celular_cliente' => $faker->phoneNumber,
        'email_cliente' => $faker->unique()->safeEmail, 
    ];
});
