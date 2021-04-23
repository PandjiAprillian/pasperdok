<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Disease::factory()->count(39)->create();
        $faker = \Faker\Factory::create('id_ID');
        $faker->seed(112);

        $diseases = [
            'Ablasi Retina', 'Abses Gigi', 'Batu Ginjal', 'Batuk', 'Batuk Rejan',
            'Biang Keringat', 'Bintitan', 'Buta Warna', 'Cacar Monyet', 'Demam Berdarah',
            'Demam Kuning', 'Diabetes', 'Dislokasi Bahu', 'Ebola', 'Flu Burung', 'Gagal Ginjal',
            'Batu Ginjal', 'Usus Buntu', 'Tubercolosis (TBC)', 'Hepatitis', 'Tipes', 'Panas Dingin',
            'Herpes', 'Hipertensi', 'Infeksi Ginjal', 'Insomnia', 'Kanker Darah', 'Kanker Kulit',
            'Muntah Darah', 'Karang Gigi', 'Panu', 'Jamur', 'Asam Lambung', 'Rematik', 'Pilek',
            'Migrain', 'Polio', 'Rabun Jauh', 'Rabun Dekat', 'Sariawan'
        ];

        for($i = 1; $i <= 39; $i++) {
            \App\Models\Disease::create(
                [
                    'nama_penyakit' => $faker->unique()->randomElement($diseases),
                ]
            );
        }
    }
}
