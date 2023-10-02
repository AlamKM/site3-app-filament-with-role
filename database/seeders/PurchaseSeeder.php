<?php

namespace Database\Seeders;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Purchase::create([
            'user_id' => '1',
            'no_pr' => '0522090007',
            'no_po' => '',
            'local_import' => 'Local',
            'date' => '2023-09-29',
            'req_date' => '2023-09-29',
            'note' => '',
        ]);
        Purchase::create([
            'user_id' => '1',
            'no_pr' => '',
            'no_po' => '',
            'local_import' => '',
            'date' => '2023-09-29',
            'req_date' => '2023-09-29',
            'note' => '',
        ]);
        Purchase::create([
            'user_id' => '1',
            'no_pr' => '',
            'no_po' => '',
            'local_import' => '',
            'date' => '2023-09-29',
            'req_date' => '2023-09-29',
            'note' => '',
        ]);


        PurchaseItem::create([
            'purchase_id' => '1',
            'item_id' => '1',
            'quantity' => '6000',
            'notes' => '',
        ]);
    }
}
