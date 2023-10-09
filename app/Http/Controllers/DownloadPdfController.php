<?php

namespace App\Http\Controllers;

use App\Models\Fpa;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class DownloadPdfController extends Controller
{
    public function download(Fpa $record)
    {
        $customer = new Buyer([
            'name'          => 'John Doe ini customer',
            'custom_fields' => [
                'email' => 'test@example.com',
            ],
        ]);

        $item = (new InvoiceItem())->title('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->discountByPercent(10)
            ->taxRate(15)
            ->shipping(1.99)
            ->addItem($item);
        // You can additionally save generated invoice to configured disk

        return $invoice->stream();
    }

    public function downloadfpa(Fpa $record)
    {
        return view('print.printfpa');
    }
}
