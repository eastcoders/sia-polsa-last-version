<?php

use Illuminate\Support\Facades\Route;
use Modules\Akademiks\Http\Controllers\MahasiswaController;

Route::prefix('v1')->group(function () {
    // Mahasiswa
    Route::prefix('/mahasiswa')->name('mahasiswa.')->group(function () {
        Route::controller(MahasiswaController::class)->group(function () {
            Route::get('/getCountMahasiswa', 'getCountMahasiswa')->name('getCountMahasiswa');
            Route::get('/getMahasiswa', 'getMahasiswa')->name('getMahasiswa');
            Route::get('/showMahasiswa/{id}', 'showMahasiswa')->name('showMahasiswa');
            Route::post('/insertMahasiswa', 'insertMahasiswa')->name('insertMahasiswa');
            Route::put('/updateMahasiswa/{id}', 'updateMahasiswa')->name('updateMahasiswa');
            Route::delete('/deleteMahasiswa/{id}', 'deleteMahasiswa')->name('deleteMahasiswa');
        });
    });
});
