<?php

namespace Database\Factories;

use App\Models\Specialist;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $specialist = Specialist::inRandomOrder()->first();
        return [
            'doctor_name'    => fake()->name(),
            'doctor_phone'   => fake()->numerify('############'),
            'doctor_email'   => fake()->unique()->safeEmail(),
            'doctor_address' => fake()->address(),
            'specialist_id'  => $specialist->id,
            'sip'            => Str::random(10),
            'id_ihs'         => Str::random(10),
            'nik'            => fake()->numberBetween(pow(10, 15), pow(10, 16) - 1),
            'doctor_specialist_name'  => $specialist->specialist_name,
        ];
    }
}
