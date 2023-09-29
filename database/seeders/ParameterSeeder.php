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
        Parameter::create([
            'parameter' => 'Color',
            'unit' => '',
            'metode' => 'Visual',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'pH',
            'unit' => '',
            'metode' => '1.5% solution at 60oC',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => '',
            'unit' => '',
            'metode' => '',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Arsenic',
            'unit' => 'ppm',
            'metode' => '',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Lead',
            'unit' => 'ppm',
            'metode' => '',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Mercury',
            'unit' => 'ppm',
            'metode' => '',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Cadmium',
            'unit' => 'ppm',
            'metode' => '',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Total Plate Count',
            'unit' => 'cfu / gram',
            'metode' => '',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Yeast & Molds',
            'unit' => 'cfu / gram',
            'metode' => '',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Salmonella',
            'unit' => '',
            'metode' => '',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'E. Coli',
            'unit' => '',
            'metode' => '',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Water Gel Strength',
            'unit' => 'gr/cm2',
            'metode' => 'using Texture Analyzer, kobe probe P/1 KSS 1cm2, 1.5% gel at 10oC',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'KCl Gel Strength',
            'unit' => 'gr/cm2',
            'metode' => 'using Texture Analyzer, Kobe Probe P/1 KSS 1cm2 , 1.5% gel at 10&#176;C',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Cold Viscosity',
            'unit' => 'cps',
            'metode' => '1.15% Solution at 25&deg;C, 25 Minutes',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Milk Viscosity',
            'unit' => 'cps',
            'metode' => 'using Brookfield LV- DV, Spindle # 1 @ 60 rpm, 0.037% milk solution in 3.2% BF fresh milk @ 75oC',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Heavy Metals (as Pb)',
            'unit' => 'ppm',
            'metode' => '',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Glucomannan',
            'unit' => '%',
            'metode' => 'in dry base',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'metal',
            'unit' => 'ppm',
            'metode' => 'Weight Metal in powder',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Blackspek',
            'unit' => 'butir',
            'metode' => 'Visual',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Water syneresis',
            'unit' => '%',
            'metode' => '',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'KCl syneresis',
            'unit' => '%',
            'metode' => '',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Distance KCl Gel Strength',
            'unit' => 'mm',
            'metode' => '',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Distance Water Gel Strength',
            'unit' => 'mm',
            'metode' => '',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Distance Milk Gel Strength',
            'unit' => 'mm',
            'metode' => '',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Milk Gel Strength',
            'unit' => 'gr/cm2',
            'metode' => '',
            'note' => '',
        ]);
        Parameter::create([
            'parameter' => 'Distance End Product Gel Strength',
            'unit' => 'mm',
            'metode' => '',
            'note' => '',
        ]);
    }
}
