<?php

namespace Database\Seeders;

use App\Models\ItemParameter;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemParameter::create([
            'rel_parameter_id' => '1',
            'parameter_id' => '1',
            'std_nilai' => '123',
            'note' => '',
        ]);
        ItemParameter::create([
            'rel_parameter_id' => '1',
            'parameter_id' => '2',
            'std_nilai' => '123',
            'note' => '',
        ]);
        ItemParameter::create([
            'rel_parameter_id' => '2',
            'parameter_id' => '3',
            'std_nilai' => '123',
            'note' => '',
        ]);
        ItemParameter::create([
            'rel_parameter_id' => '2',
            'parameter_id' => '4',
            'std_nilai' => '123',
            'note' => '',
        ]);
        ItemParameter::create([
            'rel_parameter_id' => '3',
            'parameter_id' => '5',
            'std_nilai' => '123',
            'note' => '',
        ]);
        ItemParameter::create([
            'rel_parameter_id' => '3',
            'parameter_id' => '6',
            'std_nilai' => '123',
            'note' => '',
        ]);
        ItemParameter::create([
            'rel_parameter_id' => '4',
            'parameter_id' => '7',
            'std_nilai' => '123',
            'note' => '',
        ]);
        ItemParameter::create([
            'rel_parameter_id' => '4',
            'parameter_id' => '8',
            'std_nilai' => '123',
            'note' => '',
        ]);
        ItemParameter::create([
            'rel_parameter_id' => '5',
            'parameter_id' => '9',
            'std_nilai' => '123',
            'note' => '',
        ]);
        ItemParameter::create([
            'rel_parameter_id' => '5',
            'parameter_id' => '10',
            'std_nilai' => '123',
            'note' => '',
        ]);
        ItemParameter::create([
            'rel_parameter_id' => '6',
            'parameter_id' => '11',
            'std_nilai' => '123',
            'note' => '',
        ]);
        ItemParameter::create([
            'rel_parameter_id' => '6',
            'parameter_id' => '12',
            'std_nilai' => '123',
            'note' => '',
        ]);
        ItemParameter::create([
            'rel_parameter_id' => '6',
            'parameter_id' => '13',
            'std_nilai' => '123',
            'note' => '',
        ]);
    }
}
