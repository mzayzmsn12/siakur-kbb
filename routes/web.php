<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsulanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\JenisBantuanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PekerjaanController;
use App\Models\Proposal;
use App\Models\User;



//.. Other routes
Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
// Route::get('register', [SchoolController::class, 'show'])->name('auth.register');

// Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::group(['middleware' => ['is_admin']],function(){
  Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
  Route::get('admin/usulan', [UsulanController::class, 'adminUsulan'])->name('admin.usulan');
  Route::get('admin/status', [UsulanController::class, 'statusUsulan'])->name('status.usulan');
  Route::get('admin/pekerjaan', [PekerjaanController::class, 'pekerjaanBerlangsung'])->name('pekerjaan.usulan');
  Route::get('admin/laporan', [LaporanController::class, 'laporanAdmin'])->name('admin.laporan');
    // Route::get('admin/usulan', [SchoolController::class, 'show'])->name('admin.usulan');
  Route::get('admin/user-management', [UserController::class, 'show'])->name('admin.usermanagement');
  Route::post('admin/usulan/terima/{id}', [UsulanController::class, 'prosesUsulan'])->name('admin.prosesUsulan');
  Route::post('admin/usulan/kerjakan/{id}', [UsulanController::class, 'kerjakanUsulan'])->name('admin.kerjakanUsulan');
  Route::post('admin/usulan/tolak/{id}', [UsulanController::class, 'tolakUsulan'])->name('admin.tolakUsulan');
});

Route::middleware(['auth'])->group(function(){

  Route::get('usulan', function(){
    $proposals = Proposal::with('user')->get();
    return view('layouts.normal.usulan',['proposals'=>$proposals]);
  })->name('usulan');

  Route::get('home', [HomeController::class, 'index'])->name('home');
  Route::get('usulan', [UsulanController::class, 'usulan'])->name('usulan');
  Route::get('laporan', [LaporanController::class, 'laporan'])->name('laporan');
  Route::post('laporan/{id}', [LaporanController::class, 'kirimLaporan']);
  Route::get('usulan/upload', [UsulanController::class, 'formUsulan']);
  Route::post('usulan', [UsulanController::class, 'formUsulanProcess']);

});

// require __DIR__.'/auth.php';



// Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
