<?php

namespace Database\Seeders;

use App\Models\Specialist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Specialist::create(['specialist_name' => 'Umum']);
        Specialist::create(['specialist_name' => 'Gigi']);
        Specialist::create(['specialist_name' => 'Spesialis Anak (Pediatrician)']);
        Specialist::create(['specialist_name' => 'Spesialis Mata (Ophthalmologist)']);
        Specialist::create(['specialist_name' => 'Spesialis Kulit (Dermatologist)']);
        Specialist::create(['specialist_name' => 'Spesialis Penyakit Dalam (Internist)']);
        Specialist::create(['specialist_name' => 'Spesialis Bedah (Surgeon)']);
        Specialist::create(['specialist_name' => 'Spesialis Obstetri dan Ginekologi (Obstetrician and Gynecologist)']);
        Specialist::create(['specialist_name' => 'Spesialis Jantung (Cardiologist)']);
        Specialist::create(['specialist_name' => 'Spesialis THT (Telinga, Hidung, Tenggorokan) (Otorhinolaryngologist)']);
    }
}
