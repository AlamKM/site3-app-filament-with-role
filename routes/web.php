<?php

use App\Filament\Pages\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DownloadPdfController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('http://127.0.0.1:8096/admin/login');
});

Route::get('/{record}/pdf/downloadfpa', [DownloadPdfController::class, 'downloadpdf'])->name('fpa.pdf.download');
