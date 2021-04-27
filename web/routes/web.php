<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LkkaController;
use App\Http\Controllers\MainLkkaController;
use App\Http\Controllers\MainSp2dController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LaporanMonevController;
use App\Http\Controllers\RealisasiFisikController;

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


Route::group(['middleware' => 'auth'], function () {
   	//Route::auth();

	Route::post('/realisasi/fisik/store', [RealisasiFisikController::class, 'store'])->name('realisasi.fisik.store');


    Route::get('/', 
    	[HomepageController::class, 'index'])
    ->name('dashboard');

    ######### SP2D #############

	Route::get('/sp2d', [MainController::class, 'sp2d_view'])->name('sp2d');

	Route::post('/sp2d/store', [MainController::class, 'sp2d_store'])->name('sp2d.store');
	
	Route::post('/sp2d-detail/{id}/store', [MainController::class, 'sp2d_akun_store'])->name('sp2d.detail.store');

	Route::post('/sp2d-detail/{id}/edit', [MainController::class, 'sp2d_akun_edit'])->name('sp2d.detail.edit');

	Route::post('/sp2d-detail/{id}/delete', [MainController::class, 'sp2d_akun_destroy'])->name('sp2d.detail.delete');

	Route::get('/sp2d-detail/{id}', [MainController::class, 'sp2d_view_detail'])->name('sp2d.detail');

	Route::get('/sp2d-detail/{id}?button=delete', [MainController::class, 'sp2d_view_detail'])->name('sp2d.detail.delete-btn');

	Route::post('/sp2d-valid/{id}', [MainSp2dController::class, 'akun_validasi'])->name('sp2d.valid');

	Route::post('/sp2d-valid/{id}/store', [MainSp2dController::class, 'akun_validasi_store'])->name('sp2d.valid.store');


	######### SP2D #############


	######### LKKA #############

	Route::get('/lkka', [MainLkkaController::class, 'LKKA_View'])->name('lkka');	

	######### LKKA #############


	####### AKTIVITAS #####

	Route::get('/lkka/act/{id}', [LkkaController::class, 'detail_act'])->name('lkka_act');

	Route::post('/lkka-detail-act/{id}/store', [LkkaController::class, 'act_store'])->name('act_store');

	Route::post('/lkka-detail-act/{id}/update', [LkkaController::class, 'act_edit'])->name('act_edit');

	Route::post('/lkka-detail-act/{id}/destroy', [LkkaController::class, 'act_destroy'])->name('act_destroy');

	####### AKTIVITAS #####

	####### KRO #####

	Route::get('/lkka/kro/{id}', [LkkaController::class, 'detail_kro'])->name('lkka_kro');

	Route::post('/lkka-detail-kro/{id}/store', [LkkaController::class, 'kro_store'])->name('kro_store');

	Route::post('/lkka-detail-kro/{id}/update', [LkkaController::class, 'kro_edit'])->name('kro_edit');

	Route::post('/lkka-detail-kro/{id}/destroy', [LkkaController::class, 'kro_destroy'])->name('kro_destroy');

	####### KRO #####

	####### RO #####

	Route::get('/lkka/ro/{id}', [LkkaController::class, 'detail_ro'])->name('lkka_ro');

	Route::post('/lkka-detail-ro/{id}/store', [LkkaController::class, 'ro_store'])->name('ro_store');

	Route::post('/lkka-detail-ro/{id}/update', [LkkaController::class, 'ro_edit'])->name('ro_edit');

	Route::post('/lkka-detail-ro/{id}/destroy', [LkkaController::class, 'ro_destroy'])->name('ro_destroy');

	####### RO #####

	####### Komponen #####

	Route::get('/lkka/komponen/{id}', [LkkaController::class, 'detail_komponen'])->name('lkka_komponen');

	Route::post('/lkka-detail-komponen/{id}/store', [LkkaController::class, 'komponen_store'])->name('komponen_store');

	Route::post('/lkka-detail-komponen/{id}/update', [LkkaController::class, 'komponen_edit'])->name('komponen_edit');

	Route::post('/lkka-detail-komponen/{id}/destroy', [LkkaController::class, 'komponen_destroy'])->name('komponen_destroy');

	####### Komponen #####

	####### subKomponen #####

	Route::get('/lkka/subkomponen/{id}', [LkkaController::class, 'detail_subkomponen'])->name('lkka_subkomponen');

	Route::post('/lkka-detail-subkomponen/{id}/store', [LkkaController::class, 'subkomponen_store'])->name('subkomponen_store');

	Route::post('/lkka-detail-subkomponen/{id}/update', [LkkaController::class, 'subkomponen_edit'])->name('subkomponen_edit');

	Route::post('/lkka-detail-subkomponen/{id}/destroy', [LkkaController::class, 'subkomponen_destroy'])->name('subkomponen_destroy');

	####### subKomponen #####

	####### AKUN #####

	Route::get('/lkka/akun/{id}', [MainController::class, 'lkka_detail_akun'])->name('lkka_akun');

	Route::post('/lkka-detail-akun/{id}/store', [MainController::class, 'lkka_akun_store'])->name('lkka_akun_store');

	Route::post('/lkka-detail-akun/{id}/update', [MainController::class, 'lkka_akun_edit'])->name('lkka_akun_edit');

	Route::post('/lkka-detail-akun/{id}/destroy', [MainController::class, 'lkka_akun_destroy'])->name('lkka_akun_destroy');

	####### AKUN #####

	####### Laporan Monev #####

	Route::get('/laporan/monev', [LaporanMonevController::class, 'index'])->name('lap.monev');

	####### Laporan Monev #####

	####### Realisasi Fisik #####

	Route::get('/realisasi/fisik', [RealisasiFisikController::class, 'index'])->name('realisasi.fisik');

	####### Realisasi Fisik #####
	

	Route::get('/logout', [AuthenticatedSessionController::class, 'destroy']);

});   


require __DIR__.'/auth.php';
