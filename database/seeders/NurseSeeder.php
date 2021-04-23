<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NurseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Nurse::factory()->count(15)->create();
        $faker = \Faker\Factory::create('id_ID');
        $faker->seed(456);

        $dafir = \App\Models\User::create(
            [
                'nama'              => 'Daya Firmansyah',
                'email'             => 'dafir@gmail.com',
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
            ]
        );

        $dafir->nurse()->create(
            [
                'nip'           => '19182523',
                'nama'          => 'Daya Firmansyah',
                'alamat'        => $faker->address,
                'tanggal_lahir' => $faker->dateTimeBetween('-50 years', 'now'),
                'jenis_kelamin' => 'L',
                'handphone'     => $faker->unique()->phoneNumber,
                'room_id'       => $faker->numberBetween(1, \App\Models\Room::count()),
            ]
        );

        $dafir->assignRole('nurse');

        for ($i = 2; $i <= 15; $i++) {
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

            $user->nurse()->create(
                [
                    'nip'           => $faker->unique()->numerify('########'),
                    'nama'          => $nama,
                    'alamat'        => $faker->address,
                    'tanggal_lahir' => $faker->dateTimeBetween('-50 years', 'now'),
                    'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                    'handphone'     => $faker->unique()->phoneNumber,
                    'room_id'       => $faker->numberBetween(1, \App\Models\Room::count()),
                ]
            );

            $user->assignRole('nurse');
        }
    }
}
