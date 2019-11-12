<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Sisswa;
use Faker\Generator as Faker;

$factory->define(Sisswa::class, function (Faker $faker) {
    return [
        'nama_depan' => $faker->name,
        'nama_belakang' => '',
        'falkutas' => $faker->randomElement(['Teknik Informatika','Sistem Informatika','Manajemen','Akuntasi','Hukum','Teknik Fisika','Teknik Kimia','Teknik Industri']),
        'jenis_kelamin' => $faker ->randomElement(['L','P']),
        'agama' => $faker->randomElement(['Islam','Kristen','Katolik','Budha','Hindu']),
        'alamat' => $faker->address,
        'tgl_lahir' => $faker->date(),
    ];
});
