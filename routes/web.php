<?php

// use Illuminate\Foundation\Auth;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\LokasiBukuController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\OfferingController;
use App\Http\Controllers\PinjamController;

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
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


Route::get('/log', [AdminController::class, 'log'])->name('log');

Route::middleware(['auth:sanctum', 'verified'])->middleware('can:isAdmin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/buku', [BukuController::class, 'index']);
    Route::get('/admin/buku/create', [BukuController::class, 'create']);
    Route::post('/admin/buku/insert', [BukuController::class, 'store']);
    Route::get('/admin/buku/edit/{id}', [BukuController::class, 'edit']);
    Route::patch('/admin/buku/update/{id}', [BukuController::class, 'update']);
    Route::get('/admin/buku/delete/{id}', [BukuController::class, 'destroy']);

    Route::get('/admin/user', [UserController::class,'index'])->name('user');
    Route::get('/admin/user/create', [UserController::class,'create']);
    Route::post('/admin/user/insert', [UserController::class,'store']);
    Route::get('/admin/user/edit/{id}', [UserController::class,'edit']);
    Route::patch('/admin/user/update/{id}', [UserController::class,'update']);
    Route::get('/admin/user/delete/{id}', [UserController::class,'destroy']);

    Route::get('/admin/lokasi_buku', [LokasiBukuController::class, 'index'])->name('buku');
    Route::get('/admin/lokasi_buku/create', [LokasiBukuController::class, 'create']);
    Route::post('/admin/lokasi_buku/insert', [LokasiBukuController::class, 'store']);
    Route::get('/admin/lokasi_buku/edit/{id}/', [LokasiBukuController::class, 'edit']);
    Route::patch('/admin/lokasi_buku/update/{id}/', [LokasiBukuController::class, 'update']);
    Route::get('/admin/lokasi_buku/delete/{id}/', [LokasiBukuController::class, 'destroy']);

    Route::get('/admin/jurusan', [JurusanController::class, 'index'])->name('jurusan');
    Route::get('/admin/jurusan/create', [JurusanController::class, 'create']);
    Route::post('/admin/jurusan/insert', [JurusanController::class, 'store']);
    Route::get('/admin/jurusan/edit/{id}', [JurusanController::class, 'edit']);
    Route::patch('/admin/jurusan/update/{id}', [JurusanController::class, 'update']);
    Route::get('/admin/jurusan/delete/{id}', [JurusanController::class, 'destroy']);

    Route::get('/admin/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::get('/admin/kelas/create', [KelasController::class, 'create']);
    Route::post('/admin/kelas/insert', [KelasController::class, 'store']);
    Route::get('/admin/kelas/edit/{id}', [KelasController::class, 'edit']);
    Route::patch('/admin/kelas/update/{id}', [KelasController::class, 'update']);
    Route::get('/admin/kelas/delete/{id}', [KelasController::class, 'destroy']);

    Route::get('/admin/offering', [OfferingController::class, 'index'])->name('offering');
    Route::get('/admin/offering/create', [OfferingController::class, 'create']);
    Route::post('/admin/offering/insert', [OfferingController::class, 'store']);
    Route::get('/admin/offering/edit/{id}', [OfferingController::class, 'edit']);
    Route::patch('/admin/offering/update/{id}', [OfferingController::class, 'update']);
    Route::get('/admin/offering/delete/{id}', [OfferingController::class, 'destroy']);

    Route::get('/admin/pinjam', [PinjamController::class, 'index']);
    Route::get('/admin/pinjam/kembali/{id}', [PinjamController::class, 'kembali']);
    Route::get('/admin/pinjam/status_denda/{id}', [PinjamController::class, 'statusDenda']);
    
    Route::get('/admin/profil', [AdminController::class, 'profil']);
    Route::get('/admin/profil/edit/{id}', [AdminController::class, 'editProfil']);
    Route::patch('/admin/profil/update/{id}', [AdminController::class, 'updateProfil']);
    Route::get('/image/{filename}', [AdminController::class, 'displayImage'])->name('image.displayImage');

});

Route::middleware(['auth:sanctum', 'verified'])->middleware('can:isUser')->group(function () {
    Route::get('/user', [UserController::class, 'indexUser'])->name('user');
    Route::get('/user/buku', [UserController::class, 'bukuUser']);
    Route::get('/user/pinjam', [UserController::class, 'pinjamUser']);
    Route::get('/user/buku/ajax/{id}', [BukuController::class, 'userBukuAjax']);
    Route::get('/user/buku/ajax/pinjam/{id}', [BukuController::class, 'userBukuAjaxPinjam']);
    Route::get('/user/pinjam/response', [BukuController::class, 'responsePinjam']);
    
});

