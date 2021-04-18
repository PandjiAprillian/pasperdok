<?php

namespace Database\Factories;

use App\Models\Disease;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiseaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Disease::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $diseases = [
            'Ablasi Retina', 'Abses Gigi', 'Batu Ginjal', 'Batuk', 'Batuk Rejan',
            'Biang Keringat', 'Bintitan', 'Buta Warna', 'Cacar Monyet', 'Demam Berdarah',
            'Demam Kuning', 'Diabeter', 'Dislokasi Bahu', 'Ebola', 'Flu Burung', 'Gagal Ginjal',
            'Batu Ginjal', 'Usus Buntu', 'Tubercolosis (TBC)', 'Hepatitis', 'Tipes', 'Panas Dingin',
            'Herpes', 'Hipertensi', 'Infeksi Ginjal', 'Insomnia', 'Kanker Darah', 'Kanker Kulit',
            'Muntah Darah', 'Karang Gigi', 'Panu', 'Jamur', 'Asam Lambung', 'Rematik', 'Pilek',
            'Migrain', 'Polio', 'Rabun Jauh', 'Rabun Dekat', 'Sariawan'
        ];

        return [
            'nama_penyakit' => $this->faker->unique()->randomElement($diseases),
            'doctor_id'     => $this->faker->numberBetween(1, \App\Models\Doctor::count())
        ];
    }
}
