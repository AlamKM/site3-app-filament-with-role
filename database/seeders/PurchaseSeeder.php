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
            'no_pr' => '0523010001',
            'no_po' => 'DD23010014',
            'local_import' => 'Local',
            'date' => '2023-01-16',
            'req_date' => '2023-02-28',
            'note' => 'Untuk Keb SGP-220D PO 18 ton',
        ]);
        Purchase::create([
            'user_id' => '1',
            'no_pr' => '0523010002',
            'no_po' => 'DD23020001',
            'local_import' => 'Local',
            'date' => '2023-01-16',
            'req_date' => '2023-02-28',
            'note' => 'untuk Keb SGP-220D 18 ton',
        ]);
        Purchase::create([
            'user_id' => '1',
            'no_pr' => '0523010003',
            'no_po' => 'DD23010015',
            'local_import' => 'Local',
            'date' => '2023-01-24',
            'req_date' => '2023-02-28',
            'note' => 'Untuk Keb SGP-2045G  & SGP-505S',
        ]);
        Purchase::create([
            'user_id' => '1',
            'no_pr' => '0523020001',
            'no_po' => 'DD23020004',
            'local_import' => 'Local',
            'date' => '2023-02-02',
            'req_date' => '2023-03-10',
            'note' => 'Mutasi dr IEI',
        ]);
        Purchase::create([
            'user_id' => '1',
            'no_pr' => '0523020002',
            'no_po' => 'DD23030001',
            'local_import' => 'Import',
            'date' => '2023-02-23',
            'req_date' => '2023-04-30',
            'note' => '',
        ]);
        Purchase::create([
            'user_id' => '1',
            'no_pr' => '0523020003',
            'no_po' => 'DD23020011',
            'local_import' => 'Local',
            'date' => '2023-02-23',
            'req_date' => '2023-03-31',
            'note' => '',
        ]);
        Purchase::create([
            'user_id' => '1',
            'no_pr' => '0523050001',
            'no_po' => 'DD23050003',
            'local_import' => 'Local',
            'date' => '2023-05-04',
            'req_date' => '2023-06-20',
            'note' => '',
        ]);
        Purchase::create([
            'user_id' => '1',
            'no_pr' => '0523050002',
            'no_po' => 'DD23050005',
            'local_import' => 'Import',
            'date' => '2023-05-15',
            'req_date' => '2023-08-21',
            'note' => '',
        ]);
        Purchase::create([
            'user_id' => '1',
            'no_pr' => '0523050004',
            'no_po' => 'DD23050005',
            'local_import' => 'Import',
            'date' => '2023-05-29',
            'req_date' => '2023-08-21',
            'note' => 'u/ kebutuhan SGP-220D & SGP-R10i',
        ]);
        Purchase::create([
            'user_id' => '1',
            'no_pr' => '0523070001',
            'no_po' => 'DD23070006',
            'local_import' => 'Local',
            'date' => '2023-07-06',
            'req_date' => '2023-08-07',
            'note' => 'Untuk keb SGP-5335G (rev MOQ 40 kg)',
        ]);
        Purchase::create([
            'user_id' => '1',
            'no_pr' => '0523090001',
            'no_po' => 'DD23090001',
            'local_import' => 'Local',
            'date' => '2023-09-06',
            'req_date' => '2023-10-09',
            'note' => '',
        ]);


        PurchaseItem::create([
            'purchase_id' => '1',
            'item_id' => '123',
            'quantity' => '5000',
            'notes' => '',
        ]);
        PurchaseItem::create([
            'purchase_id' => '2',
            'item_id' => '122',
            'quantity' => '5000',
            'notes' => '',
        ]);
        PurchaseItem::create([
            'purchase_id' => '3',
            'item_id' => '111',
            'quantity' => '1300',
            'notes' => '',
        ]);
        PurchaseItem::create([
            'purchase_id' => '4',
            'item_id' => '122',
            'quantity' => '30000',
            'notes' => '',
        ]);
        PurchaseItem::create([
            'purchase_id' => '5',
            'item_id' => '108',
            'quantity' => '500',
            'notes' => '',
        ]);
        PurchaseItem::create([
            'purchase_id' => '6',
            'item_id' => '161',
            'quantity' => '50',
            'notes' => '',
        ]);
        PurchaseItem::create([
            'purchase_id' => '7',
            'item_id' => '123',
            'quantity' => '5000',
            'notes' => '',
        ]);
        PurchaseItem::create([
            'purchase_id' => '8',
            'item_id' => '109',
            'quantity' => '10000',
            'notes' => '',
        ]);
        PurchaseItem::create([
            'purchase_id' => '9',
            'item_id' => '104',
            'quantity' => '2000',
            'notes' => '',
        ]);
        PurchaseItem::create([
            'purchase_id' => '10',
            'item_id' => '140',
            'quantity' => '40',
            'notes' => '',
        ]);

        PurchaseItem::create([
            'purchase_id' => '11',
            'item_id' => '122',
            'quantity' => '10000',
            'notes' => '',
        ]);
    }
}
