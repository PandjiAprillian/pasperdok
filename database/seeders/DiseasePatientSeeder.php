<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DiseasePatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $faker->seed(749);

        for($i = 1; $i <= 15; $i++) {
            \App\Models\DiseasePatient::create(
                [
                    'patient_id' => $faker->numberBetween(1, \App\Models\Patient::count()),
                    'disease_id' => $faker->numberBetween(1, \App\Models\Disease::count())
                ]
            );
        }
    }
}
