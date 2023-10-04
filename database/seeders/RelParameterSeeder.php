<?php

namespace Database\Seeders;

use App\Models\RelParameter;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RelParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RelParameter::create([
            'item_id' => '113',
        ]);
        RelParameter::create([
            'item_id' => '112',
        ]);
        RelParameter::create([
            'item_id' => '101',
        ]);
        RelParameter::create([
            'item_id' => '98',
        ]);
        RelParameter::create([
            'item_id' => '99',
        ]);
        RelParameter::create([
            'item_id' => '94',
        ]);
        RelParameter::create([
            'item_id' => '130',
        ]);
    }
}
