<?php

use Illuminate\Support\Facades\Route;
use Modules\Akademiks\Http\Controllers\AkademiksController;
use Modules\Akademiks\Livewire\Mahasiswa\Index;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('akademiks', AkademiksController::class)->names('akademiks');

    Route::get('/data-mahasiswa', Index::class)
        ->name('akademiks.data-mahasiswa.index');
});
