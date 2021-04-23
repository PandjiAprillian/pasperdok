<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Doctor::factory()->count(20)->create();
        $faker = \Faker\Factory::create('id_ID');
        $faker->seed(123);

        $safa = \App\Models\User::create(
            [
                'nama'              => 'Dr. Muhamad Syafa',
                'email'             => 'syafa@gmail.com',
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token'    => Str::random(10),
            ]
        );

        $safa->doctor()->create(
            [
                'nid'           => '19182339',
                'nama'          => 'Dr. Muhamad Syafa',
                'alamat'        => $faker->address,
                'tanggal_lahir' => $faker->dateTimeBetween('-50 years', 'now'),
                'jenis_kelamin' => 'L',
                'handphone'     => $faker->unique()->phoneNumber,
                'disease_id'    => $faker->numberBetween(1, \App\Models\Disease::count())
            ]
        );

        $safa->assignRole('doctor');

        for ($i = 1; $i <= 20; $i++) {
            $nama = "Dr. {$faker->firstName} {$faker->lastName}";

            $user = \App\Models\User::create(
                [
                    'nama'              => $nama,
                    'email'             => $faker->unique()->safeEmail,
                    'email_verified_at' => now(),
                    'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'remember_token'    => Str::random(10),
                ]
            );

            $user->doctor()->create(
                [
                    'nid'           => $faker->unique()->numerify('########'),
                    'nama'          => $nama,
                    'alamat'        => $faker->address,
                    'tanggal_lahir' => $faker->dateTimeBetween('-50 years', 'now'),
                    'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                    'handphone'     => $faker->unique()->phoneNumber,
                    'disease_id'    => $faker->numberBetween(1, \App\Models\Disease::count())
                ]
            );

            $user->assignRole('doctor');
        }
    }
}
