<?php

namespace Database\Seeders;

use App\Models\Parameter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parameter::create([
            'parameter' => 'End Product Gel Strength',
            'unit' => 'g/cm2',
            'metode' => 'using Texture Analyzer, Kobe Probe P/1 KSS 1cm2 , 1.5% gel at 10oC',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Water viscosity',
            'unit' => 'cps',
            'metode' => 'using Brookfield LV-DV, spindle #2 at 30 rpm, 1.5% solution at 75oC.',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Particle Size',
            'unit' => '%',
            'metode' => 'pass through 60 mesh',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Moisture Content',
            'unit' => '%',
            'metode' => 'using Sartorius MA-30 at 105oC',
            'note' => '',
        ]);
    }
}
