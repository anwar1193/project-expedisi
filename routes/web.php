<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\DaftarPengeluaranController;
use App\Http\Controllers\SurveilanceCarController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\JenisPerangkatController;
use App\Http\Controllers\PerangkatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataPengirimanController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ObdController;
use App\Http\Controllers\LastLoginController;
use App\Http\Controllers\ObdTrackerController;
use App\Http\Controllers\PemantauanController;
use App\Http\Controllers\RiwayatArmadaController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TestingController;

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

@include_once('admin_web.php');

// Route::get('/', function () {
//     return redirect()->route('index');
// })->name('/');

Route::middleware("guest")->group(function() {

    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('signin');

});

Route::middleware("auth")->group(function() {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::prefix('/')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('dashboard/log-perjalanan/{id}', [DashboardController::class, 'riwayatArmada'])->name('dashboard.log');
        Route::get('dashboard/location/{id}', [DashboardController::class, 'lokasiArmada'])->name('dashboard.location');
    });

    Route::get('atur-tema', [ThemeController::class, 'index'])->name('tema');

    Route::view('sample-page', 'admin.pages.sample-page')->name('sample-page');

    Route::view('default-layout', 'multiple.default-layout')->name('default-layout');
    Route::view('compact-layout', 'multiple.compact-layout')->name('compact-layout');
    Route::view('modern-layout', 'multiple.modern-layout')->name('modern-layout');

    Route::prefix('master')->group(function () {

        Route::get('surveilance-car', [SurveilanceCarController::class, 'index'])->name('surveilance-car');
        Route::get('surveilance-car/create', [SurveilanceCarController::class, 'create'])->name('surveilance-car.create');
        Route::post('surveilance-car/store', [SurveilanceCarController::class, 'store'])->name('surveilance-car.store');
        Route::get('surveilance-car/edit/{id}', [SurveilanceCarController::class, 'edit'])->name('surveilance-car.edit');
        Route::post('surveilance-car/update', [SurveilanceCarController::class, 'update'])->name('surveilance-car.update');
        Route::get('surveilance-car/delete/{id}', [SurveilanceCarController::class, 'delete'])->name('surveilance-car.delete');
        Route::get('surveilance-car/detail/{id}', [SurveilanceCarController::class, 'detail'])->name('surveilance-car.detail');
        Route::get('surveilance-car/export-pdf', [SurveilanceCarController::class, 'export_pdf'])->name('surveilance-car.export-pdf');
        Route::get('surveilance-car/export-excel', [SurveilanceCarController::class, 'export_excel'])->name('surveilance-car.export-excel');

        Route::get('jenis-perangkat', [JenisPerangkatController::class, 'index'])->name('jenis-perangkat');
        Route::get('jenis-perangkat/create', [JenisPerangkatController::class, 'create'])->name('jenis-perangkat.create');
        Route::post('jenis-perangkat/store', [JenisPerangkatController::class, 'store'])->name('jenis-perangkat.store');
        Route::get('jenis-perangkat/edit/{id}', [JenisPerangkatController::class, 'edit'])->name('jenis-perangkat.edit');
        Route::post('jenis-perangkat/update', [JenisPerangkatController::class, 'update'])->name('jenis-perangkat.update');
        Route::get('jenis-perangkat/delete/{id}', [JenisPerangkatController::class, 'delete'])->name('jenis-perangkat.delete');

        Route::get('perangkat', [PerangkatController::class, 'index'])->name('perangkat');
        Route::get('perangkat/create', [PerangkatController::class, 'create'])->name('perangkat.create');
        Route::post('perangkat/store', [PerangkatController::class, 'store'])->name('perangkat.store');
        Route::get('perangkat/edit/{id}', [PerangkatController::class, 'edit'])->name('perangkat.edit');
        Route::post('perangkat/update', [PerangkatController::class, 'update'])->name('perangkat.update');
        Route::get('perangkat/delete/{id}', [PerangkatController::class, 'delete'])->name('perangkat.delete');
        Route::get('perangkat/detail/{id}', [PerangkatController::class, 'detail'])->name('perangkat.detail');
        Route::get('perangkat/export-pdf', [PerangkatController::class, 'export_pdf'])->name('perangkat.export-pdf');
        Route::get('perangkat/export-excel', [PerangkatController::class, 'export_excel'])->name('perangkat.export-excel');

        Route::get('obd', [ObdController::class, 'index'])->name('obd');
        Route::get('obd/create', [ObdController::class, 'create'])->name('obd.create');
        Route::post('obd/store', [ObdController::class, 'store'])->name('obd.store');
        Route::get('obd/edit/{id}', [ObdController::class, 'edit'])->name('obd.edit');
        Route::post('obd/update', [ObdController::class, 'update'])->name('obd.update');
        Route::get('obd/delete/{id}', [ObdController::class, 'delete'])->name('obd.delete');
        Route::get('obd/detail/{id}', [ObdController::class, 'detail'])->name('obd.detail');
        Route::get('obd/export-pdf', [ObdController::class, 'export_pdf'])->name('obd.export-pdf');
        Route::get('obd/export-excel', [ObdController::class, 'export_excel'])->name('obd.export-excel');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        // Route::get('users/detil/{targetId}', [UserController::class, 'detail'])->name('users.detil');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::get('/detail/{id}', [UserController::class, 'detail'])->name('users.detail');
        Route::post('/update', [UserController::class, 'update'])->name('users.update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
        Route::get('/export-pdf', [UserController::class, 'export_pdf'])->name('users.export-pdf');
        Route::get('/export-excel', [UserController::class, 'export_excel'])->name('users.export-excel');
    });

    Route::get('log-activity', [LogActivityController::class, 'index'])->name('log-activity');
    Route::get('log-activity/export-pdf', [LogActivityController::class, 'export_pdf'])->name('log-activity.export-pdf');
    Route::get('log-activity/export-excel', [LogActivityController::class, 'export_excel'])->name('log-activity.export-excel');
    
    // Route::prefix('analisa-statistik')->group(function () {
    //     Route::get('last-login', [LastLoginController::class, 'index'])->name('last-login');
    // });

    Route::get('last-login', [LastLoginController::class, 'index'])->name('last-login');

    Route::prefix('pengaturan')->group(function () {
        Route::get('ganti-password', [UserController::class, 'gantiPassword'])->name('ganti-password');
        Route::post('ganti-password-proses', [UserController::class, 'gantiPasswordProses'])->name('ganti-password.proses');
        Route::post('ganti-foto-proses', [UserController::class, 'update_foto'])->name('ganti-foto');
        Route::get('profile', [UserController::class, 'profile'])->name('profile');
        Route::post('profile/update', [UserController::class, 'update_profile'])->name('profile.update');
        Route::get('hak-akses', [UserController::class, 'hak_akses'])->name('hak-akses');
        Route::post('hak-akses/update', [UserController::class, 'updateHakAkses'])->name('hak-akses.update');
    });

    Route::get('pemantauan-gps',[PemantauanController::class, 'index'])->name('pemantauan-gps');

    Route::prefix('pemantauan-camera')->group(function () {
        Route::get('/', [CameraController::class, 'index'])->name('pemantauan-camera');
        Route::get('detail/{id}', [CameraController::class, 'detail'])->name('pemantauan-camera.detail');
        Route::post('front-camera', [CameraController::class, 'store_front_camera'])->name('store.front-camera');
        Route::post('rear-camera', [CameraController::class, 'store_rear_camera'])->name('store.rear-camera');
        Route::get('image/front-camera/{id}', [CameraController::class, 'detail_front_camera'])->name('pemantauan-camera.front');
        Route::get('image/rear-camera/{id}', [CameraController::class, 'detail_rear_camera'])->name('pemantauan-camera.rear');
        Route::get('front-camera', [CameraController::class, 'front_camera'])->name('front-camera');
        Route::get('rear-camera', [CameraController::class, 'rear_camera'])->name('rear-camera');
    });

    Route::prefix('obd-tracker')->group(function () {
        Route::get('/', [ObdTrackerController::class, 'index'])->name('obd-tracker');
        Route::post('/hubungkan', [ObdTrackerController::class, 'hubungkan_obd'])->name('obd-connect-car');
        Route::post('/lepaskan', [ObdTrackerController::class, 'lepaskan_obd'])->name('obd-disconnect-car');
        Route::post('/switch-engine', [ObdTrackerController::class, 'switch_engine'])->name('obd-switch-engine');
    });

    Route::prefix('riwayat-armada')->group(function () {
        Route::get('/', [RiwayatArmadaController::class, 'index'])->name('riwayat-armada');
    });
    
    Route::prefix('data-pengiriman')->group(function () {
        Route::get('/', [DataPengirimanController::class, 'index'])->name('data-pengiriman');
        Route::get('/create', [DataPengirimanController::class, 'create'])->name('data-pengiriman.create');
        Route::get('/edit/{id}', [DataPengirimanController::class, 'edit'])->name('data-pengiriman.edit');
        Route::post('/', [DataPengirimanController::class, 'store'])->name('data-pengiriman.store');
        Route::post('/update/{id}', [DataPengirimanController::class, 'update'])->name('data-pengiriman.update');
        Route::get('/delete/{id}', [DataPengirimanController::class, 'delete'])->name('data-pengiriman.delete');
        Route::post('/status-pembayaran', [DataPengirimanController::class, 'ubah_status_pembayaran'])->name('data-pengiriman.status');
        Route::post('/import-excel', [DataPengirimanController::class, 'import_excel'])->name('data-pengiriman.import_excel');
    });
    
    Route::prefix('daftar-pengeluaran')->group(function () {
        Route::get('/', [DaftarPengeluaranController::class, 'index'])->name('daftar-pengeluaran');
        Route::get('/create', [DaftarPengeluaranController::class, 'create'])->name('daftar-pengeluaran.create');
        Route::get('/edit/{id}', [DaftarPengeluaranController::class, 'edit'])->name('daftar-pengeluaran.edit');
        Route::post('/', [DaftarPengeluaranController::class, 'store'])->name('daftar-pengeluaran.store');
        Route::post('/update/{id}', [DaftarPengeluaranController::class, 'update'])->name('daftar-pengeluaran.update');
        Route::get('/delete/{id}', [DaftarPengeluaranController::class, 'delete'])->name('daftar-pengeluaran.delete');
    });
    
    Route::prefix('supplier')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('supplier');
        Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create');
        Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::post('/', [SupplierController::class, 'store'])->name('supplier.store');
        Route::post('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::get('/delete/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');
    });

    Route::get('user-level', [UserController::class, 'listLevel'])->name('level');

    Route::get('testing', [TestingController::class, 'index']);
});