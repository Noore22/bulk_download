<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Mews\Captcha\Facades\Captcha;
use App\Livewire\FirstComponent;
use App\Exports\MiReportExport;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


 
Route::get('/FirstComponent', FirstComponent::class);

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/captcha/reload', function () {
    return response()->json(['captcha' => Captcha::img()]);
})->name('captcha.reload');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route::get('/export-users-csv', [MiReportExport::class, 'exportLargeCSV'])->name('export.users.csv');

// Route::get('/export-users-csv', function () {
//     return (new \App\Exports\MiReportExport)->exportLargeCSV();
// })->name('export.users.csv');


// Route::get('/export-mi-reports', [MiReportExport::class, 'streamCSV'])->name('export-mi-report');

Route::get('/export-mi-reports', function (MiReportExport $export) {
    return $export->streamCSV();
})->name('export-mi-report');

Route::get('/upload', function () {
    return view('livewire.file-upload');
});
