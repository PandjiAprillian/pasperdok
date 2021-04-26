<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Room::factory()->count(30)->create();
        $faker = \Faker\Factory::create('id_ID');
        $faker->seed(623);

        for($i = 1; $i <= 30; $i++) {
            \App\Models\Room::create(
                [
                    'nomor_kamar' => $faker->unique()->bothify('?##'),
                    'maksimal' => '2'
                ]
            );
        }
    }
}
