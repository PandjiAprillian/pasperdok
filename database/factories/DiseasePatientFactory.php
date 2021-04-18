<?php

namespace Database\Factories;

use App\Models\DiseasePatient;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiseasePatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DiseasePatient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'patient_id' => $this->faker->numberBetween(1, \App\Models\Patient::count()),
            'disease_id' => $this->faker->numberBetween(1, \App\Models\Disease::count())
        ];
    }
}
