<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Patient::factory()->count(15)->create();
        $faker = \Faker\Factory::create('id_ID');
        $faker->seed(789);

        $rafita = \App\Models\User::create(
            [
                'nama'              => 'Rafita Suci',
                'email'             => 'rafita@test.com',
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
            ]
        );

        $rafita->patient()->create(
            [
                'nik'           => '19182604',
                'nama'          => 'Rafita Suci',
                'alamat'        => $faker->address,
                'tanggal_lahir' => $faker->dateTimeBetween('-50 years', 'now'),
                'jenis_kelamin' => 'P',
                'handphone'     => $faker->unique()->phoneNumber,
                'keluhan'       => $faker->sentence(3),
                'rawat_inap'    => 1,
                'room_id'       => $faker->numberBetween(1, \App\Models\Room::count()),
            ]
        );

        $rafita->assignRole('patient');

        for($i = 2; $i <= 5; $i++){
            $nama = "{$faker->firstName} {$faker->lastName}";

            $user = \App\Models\User::create(
                [
                    'nama'              => $nama,
                    'email'             => $faker->unique()->safeEmail,
                    'email_verified_at' => now(),
                    'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'remember_token'    => Str::random(10),
                ]
            );

            $user->patient()->create(
                [
                    'nik'           => $faker->unique()->numerify('################'),
                    'nama'          => $nama,
                    'alamat'        => $faker->address,
                    'tanggal_lahir' => $faker->dateTimeBetween('-50 years', 'now'),
                    'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                    'handphone'     => $faker->unique()->phoneNumber,
                    'keluhan'       => $faker->sentence(3),
                    'rawat_inap'    => 1,
                    'room_id'       => $faker->numberBetween(1, \App\Models\Room::count()),
                ]
            );

            $user->assignRole('patient');
        }

    }
}
