<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'item_code' => 'BA00002',
            'item_name' => 'Calcium Sulfate FG',
            'category' => 'Raw Material',
            'sub_category' => 'BLENDED',
            'unit' => 'Kgs',
            'note' => '',
        ]);
        Item::create([
            'item_code' => 'BA00003',
            'Item_name' => 'Sodium Carboxymenthyl Cellulose FG',
            'category' => 'Raw Material',
            'sub_category' => 'BLENDED',
            'unit' => 'Kgs',
            'note' => '',
        ]);
        Item::create([
            'item_code' => 'BA00008',
            'Item_name' => 'Dextrose Monohydrate FG',
            'category' => 'Raw Material',
            'sub_category' => 'BLENDED',
            'unit' => 'Kgs',
            'note' => '',
        ]);
        Item::create([
            'item_code' => 'BA00012',
            'Item_name' => 'Konjac Gum FG',
            'category' => 'Raw Material',
            'sub_category' => 'BLENDED',
            'unit' => 'Kgs',
            'note' => '',
        ]);
        Item::create([
            'item_code' => 'BA00017',
            'Item_name' => 'Potassium Chloride (KCL) FG',
            'category' => 'Raw Material',
            'sub_category' => 'BLENDED',
            'unit' => 'Kgs',
            'note' => '',
        ]);
        Item::create([
            'item_code' => 'BA00019',
            'Item_name' => 'Refined Carrageenan Iota (BLI 1130)',
            'category' => 'Raw Material',
            'sub_category' => 'BLENDED',
            'unit' => 'Kgs',
            'note' => '',
        ]);
        Item::create([
            'item_code' => 'BA00020',
            'Item_name' => 'Refined Carrageenan Kappa (BLK 1120)',
            'category' => 'Raw Material',
            'sub_category' => 'BLENDED',
            'unit' => 'Kgs',
            'note' => '',
        ]);
        Item::create([
            'item_code' => 'BA00026',
            'Item_name' => 'SRC Kappa (F 08)',
            'category' => 'Raw Material',
            'sub_category' => 'BLENDED',
            'unit' => 'Kgs',
            'note' => '',
        ]);
        Item::create([
            'item_code' => 'PM00008',
            'Item_name' => 'Paper Bag Printed Indogum Standard',
            'category' => 'Packaging Material',
            'sub_category' => 'BLENDED',
            'unit' => 'Kgs',
            'note' => '',
        ]);
        Item::create([
            'item_code' => 'PM00009',
            'Item_name' => 'Paper Bag Blank-Brown with Woven',
            'category' => 'Packaging Material',
            'sub_category' => 'BLENDED',
            'unit' => 'Kgs',
            'note' => '',
        ]);
    }
}
