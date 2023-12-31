<?php

namespace App\Http\Controllers;

use App\Models\Fpa;
use App\Models\Item;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class DownloadPdfController extends Controller
{
    public function downloadpdf(Fpa $record)
    {
        $item_id = $record->item_id;
        $item_name = $record->item->item_name;
        $departement = $record->departement;
        $lokasi = $record->lokasi;
        $created_at = $record->created_at;
        $no_lot = $record->no_lot;

        $pdf = Pdf::loadView('print.printfpa', compact('item_name', 'departement', 'lokasi', 'created_at', 'no_lot'));
        return $pdf->stream();
    }
}
