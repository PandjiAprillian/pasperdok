<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(
            [
                'name' => 'admin',
                'guard_name' => 'web'
            ]
        );

        Role::create(
            [
                'name' => 'patient',
                'guard_name' => 'web'
            ]
        );

        Role::create(
            [
                'name' => 'nurse',
                'guard_name' => 'web'
            ]
        );

        Role::create(
            [
                'name' => 'doctor',
                'guard_name' => 'web'
            ]
        );
    }
}
