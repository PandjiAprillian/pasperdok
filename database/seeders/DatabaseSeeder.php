<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(NurseSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(DiseaseSeeder::class);
        $this->call(DiseasePatientSeeder::class);
    }
}
