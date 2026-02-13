<?php

use Illuminate\Support\Facades\Route;
use Modules\Akademiks\Livewire\Mahasiswa\Index;
use Modules\Akademiks\Livewire\Mahasiswa\Create;
use Modules\Akademiks\Http\Controllers\AkademiksController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('akademiks', AkademiksController::class)->names('akademiks');

    Route::get('/data-mahasiswa', Index::class)
        ->name('akademiks.data-mahasiswa.index');

    Route::get('/data-mahasiswa/create', Create::class)
        ->name('akademiks.data-mahasiswa.create');
});
