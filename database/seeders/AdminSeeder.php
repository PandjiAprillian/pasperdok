<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $faker->seed(237);

        $admin = \App\Models\User::create(
            [
                'nama'              => 'Pandji Aprillian',
                'email'             => 'pandji@admin.com',
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ]
        );

        $admin->admin()->create(
            [
                'nama'              => 'Pandji Aprillian',
                'alamat'            => $faker->address,
                'jenis_kelamin'     => 'L',
                'handphone'         => '089696961232',
            ]
        );

        $admin->assignRole('admin');
    }
}
