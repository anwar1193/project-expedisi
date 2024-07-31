<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\LastLoginController;
use App\Http\Controllers\User\UserController;

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\PerlengkapanController;
use App\Http\Controllers\KonversiPointController;
use App\Http\Controllers\DataPengirimanController;
use App\Http\Controllers\PenukaranPointController;
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\JenisPengeluaranController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\PemasukanLainnyaController;
use App\Http\Controllers\DaftarPengeluaranController;
use App\Http\Controllers\PembelianPerlengkapanController;

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
    Route::post('register', [AuthController::class, 'register'])->name('register');

    // Google Auth
    Route::get('google-login', [GoogleAuthController::class, 'redirect'])->name('google-login');
    Route::get('auth/google/redirect', [GoogleAuthController::class, 'callback'])->name('google-login.callback');
});

Route::middleware("auth")->group(function() {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::prefix('/')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('dashboard/customer', [DashboardController::class, 'customer'])->name('dashboard.customer');
        Route::get('dashboard/log-perjalanan/{id}', [DashboardController::class, 'riwayatArmada'])->name('dashboard.log');
        Route::get('dashboard/location/{id}', [DashboardController::class, 'lokasiArmada'])->name('dashboard.location');
    });

    Route::get('atur-tema', [ThemeController::class, 'index'])->name('tema');

    Route::view('sample-page', 'admin.pages.sample-page')->name('sample-page');

    Route::view('default-layout', 'multiple.default-layout')->name('default-layout');
    Route::view('compact-layout', 'multiple.compact-layout')->name('compact-layout');
    Route::view('modern-layout', 'multiple.modern-layout')->name('modern-layout');

    Route::prefix('master-data')->group(function () {

        Route::get('jenis-pengeluaran', [JenisPengeluaranController::class, 'index'])->name('jenis-pengeluaran');
        Route::get('jenis-pengeluaran/create', [JenisPengeluaranController::class, 'create'])->name('jenis-pengeluaran.create');
        Route::post('jenis-pengeluaran/store', [JenisPengeluaranController::class, 'store'])->name('jenis-pengeluaran.store');
        Route::get('jenis-pengeluaran/edit/{id}', [JenisPengeluaranController::class, 'edit'])->name('jenis-pengeluaran.edit');
        Route::post('jenis-pengeluaran/update', [JenisPengeluaranController::class, 'update'])->name('jenis-pengeluaran.update');
        Route::get('jenis-pengeluaran/delete/{id}', [JenisPengeluaranController::class, 'delete'])->name('jenis-pengeluaran.delete');
       
        Route::get('perlengkapan', [PerlengkapanController::class, 'index'])->name('perlengkapan');
        Route::get('perlengkapan/create', [PerlengkapanController::class, 'create'])->name('perlengkapan.create');
        Route::post('perlengkapan/store', [PerlengkapanController::class, 'store'])->name('perlengkapan.store');
        Route::get('perlengkapan/edit/{id}', [PerlengkapanController::class, 'edit'])->name('perlengkapan.edit');
        Route::post('perlengkapan/update', [PerlengkapanController::class, 'update'])->name('perlengkapan.update');
        Route::get('perlengkapan/delete/{id}', [PerlengkapanController::class, 'delete'])->name('perlengkapan.delete');
        
        Route::get('merchandise', [MerchandiseController::class, 'index'])->name('merchandise');
        Route::get('merchandise/create', [MerchandiseController::class, 'create'])->name('merchandise.create');
        Route::get('merchandise/edit/{id}', [MerchandiseController::class, 'edit'])->name('merchandise.edit');
        Route::post('merchandise', [MerchandiseController::class, 'store'])->name('merchandise.store');
        Route::post('merchandise/update/{id}', [MerchandiseController::class, 'update'])->name('merchandise.update');
        Route::get('merchandise/delete/{id}', [MerchandiseController::class, 'delete'])->name('merchandise.delete');

        Route::get('bank', [BankController::class, 'index'])->name('bank');
        Route::get('bank/create', [BankController::class, 'create'])->name('bank.create');
        Route::post('bank/store', [BankController::class, 'store'])->name('bank.store');
        Route::get('bank/edit/{id}', [BankController::class, 'edit'])->name('bank.edit');
        Route::post('bank/update', [BankController::class, 'update'])->name('bank.update');
        Route::get('bank/delete/{id}', [BankController::class, 'delete'])->name('bank.delete');

        Route::get('metode_pembayaran', [MetodePembayaranController::class, 'index'])->name('metode_pembayaran');
        Route::get('metode_pembayaran/create', [MetodePembayaranController::class, 'create'])->name('metode_pembayaran.create');
        Route::post('metode_pembayaran/store', [MetodePembayaranController::class, 'store'])->name('metode_pembayaran.store');
        Route::get('metode_pembayaran/edit/{id}', [MetodePembayaranController::class, 'edit'])->name('metode_pembayaran.edit');
        Route::post('metode_pembayaran/update', [MetodePembayaranController::class, 'update'])->name('metode_pembayaran.update');
        Route::get('metode_pembayaran/delete/{id}', [MetodePembayaranController::class, 'delete'])->name('metode_pembayaran.delete');
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
        
        Route::get('role-management', [RoleManagementController::class, 'index'])->name('role-management');
        Route::get('change-permission/{id}', [RoleManagementController::class, 'changePermission'])->name('role.change-permission');
        Route::post('add-permission', [RoleManagementController::class, 'addPermission'])->name('role.add-permission');
        Route::get('role-management-create', [RoleManagementController::class, 'create'])->name('role.create');
        Route::post('role-management-store', [RoleManagementController::class, 'store'])->name('role.store');
        Route::get('role-management-edit/{id}', [RoleManagementController::class, 'edit'])->name('role.edit');
        Route::post('role-management-update', [RoleManagementController::class, 'update'])->name('role.update');
        Route::get('role-management-delete/{id}', [RoleManagementController::class, 'delete'])->name('role.delete');

        Route::get('konversi-point', [KonversiPointController::class, 'index'])->name('konversi-point');
        Route::post('konversi-point', [KonversiPointController::class, 'update'])->name('konversi-point.update');

        Route::get('pesan', [PesanController::class, 'index'])->name('pesan');
        Route::post('pesan/update', [PesanController::class, 'update'])->name('pesan.update');
    });
    
    Route::prefix('data-pengiriman')->group(function () {
        Route::get('/', [DataPengirimanController::class, 'index'])->name('data-pengiriman');
        Route::get('/create', [DataPengirimanController::class, 'create'])->name('data-pengiriman.create');
        Route::get('/edit/{id}', [DataPengirimanController::class, 'edit'])->name('data-pengiriman.edit');
        Route::post('/', [DataPengirimanController::class, 'store'])->name('data-pengiriman.store');
        Route::post('/update/{id}', [DataPengirimanController::class, 'update'])->name('data-pengiriman.update');
        Route::get('/delete/{id}', [DataPengirimanController::class, 'delete'])->name('data-pengiriman.delete');
        Route::get('/truncate', [DataPengirimanController::class, 'truncate'])->name('data-pengiriman.truncate');
        Route::post('/status-pembayaran', [DataPengirimanController::class, 'ubah_status_pembayaran'])->name('data-pengiriman.status');
        Route::post('/import-excel', [DataPengirimanController::class, 'import_excel'])->name('data-pengiriman.import_excel');
        Route::get('/approve/{id}', [DataPengirimanController::class, 'approve'])->name('data-pengiriman.approve');
        Route::post('/approve-selected', [DataPengirimanController::class, 'approveSelected'])->name('data-pengiriman.approve-selected');
        Route::post('/status-pengiriman/import-excel', [DataPengirimanController::class, 'import_status_pengiriman'])->name('status-pengiriman.import_excel');
        Route::post('/konfimasi-excel', [DataPengirimanController::class, 'konfimasiExcel'])->name('data-pengiriman.konfimasi-excel');
        Route::post('/proses-konfirmasi-excel', [DataPengirimanController::class, 'proses_hasil_import'])->name('data-pengiriman.proses-konfimasi-excel');
        Route::get('/download-resi', [DataPengirimanController::class, 'download_resi'])->name('data-pengiriman.download-resi');
    });
    
    Route::prefix('daftar-pengeluaran')->group(function () {
        Route::get('/', [DaftarPengeluaranController::class, 'index'])->name('daftar-pengeluaran');
        Route::get('/create', [DaftarPengeluaranController::class, 'create'])->name('daftar-pengeluaran.create');
        Route::get('/edit/{id}', [DaftarPengeluaranController::class, 'edit'])->name('daftar-pengeluaran.edit');
        Route::post('/', [DaftarPengeluaranController::class, 'store'])->name('daftar-pengeluaran.store');
        Route::post('/update/{id}', [DaftarPengeluaranController::class, 'update'])->name('daftar-pengeluaran.update');
        Route::get('/delete/{id}', [DaftarPengeluaranController::class, 'delete'])->name('daftar-pengeluaran.delete');
        Route::get('/approve/{id}', [DaftarPengeluaranController::class, 'approve'])->name('daftar-pengeluaran.approve');
        Route::post('/approve-selected', [DaftarPengeluaranController::class, 'approveSelected'])->name('data-pengeluaran.approve-selected');
        Route::get('/unapprove/{id}', [DaftarPengeluaranController::class, 'cancelApprove'])->name('daftar-pengeluaran.unapprove');
        Route::post('/unapprove-selected', [DaftarPengeluaranController::class, 'cancelApproveSelected'])->name('data-pengeluaran.unapprove-selected');
    });
    
    Route::prefix('supplier')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('supplier');
        Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create');
        Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::post('/', [SupplierController::class, 'store'])->name('supplier.store');
        Route::post('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::get('/delete/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');
    });

    Route::prefix('data-pemasukan')->group(function () {
        Route::get('/', [PemasukanLainnyaController::class, 'index'])->name('data-pemasukan');
        Route::get('/create', [PemasukanLainnyaController::class, 'create'])->name('data-pemasukan.create');
        Route::get('/edit/{id}', [PemasukanLainnyaController::class, 'edit'])->name('data-pemasukan.edit');
        Route::post('/', [PemasukanLainnyaController::class, 'store'])->name('data-pemasukan.store');
        Route::post('/update/{id}', [PemasukanLainnyaController::class, 'update'])->name('data-pemasukan.update');
        Route::get('/delete/{id}', [PemasukanLainnyaController::class, 'delete'])->name('data-pemasukan.delete');
        Route::get('/tanda-terima-pdf/{id}', [PemasukanLainnyaController::class, 'tanda_terima_pdf'])->name('tanda-terima.export-pdf');
    });

    Route::prefix('data-barang')->group(function () {
        Route::get('/', [BarangController::class, 'index'])->name('data-barang');
        Route::get('/create', [BarangController::class, 'create'])->name('data-barang.create');
        Route::get('/edit/{id}', [BarangController::class, 'edit'])->name('data-barang.edit');
        Route::post('/', [BarangController::class, 'store'])->name('data-barang.store');
        Route::post('/update/{id}', [BarangController::class, 'update'])->name('data-barang.update');
        Route::get('/delete/{id}', [BarangController::class, 'delete'])->name('data-barang.delete');
    });

    Route::prefix('data-jasa')->group(function () {
        Route::get('/', [JasaController::class, 'index'])->name('data-jasa');
        Route::get('/create', [JasaController::class, 'create'])->name('data-jasa.create');
        Route::get('/edit/{id}', [JasaController::class, 'edit'])->name('data-jasa.edit');
        Route::post('/', [JasaController::class, 'store'])->name('data-jasa.store');
        Route::post('/update/{id}', [JasaController::class, 'update'])->name('data-jasa.update');
        Route::get('/delete/{id}', [JasaController::class, 'delete'])->name('data-jasa.delete');
    });

    Route::prefix('barang-masuk')->group(function () {
        Route::get('/', [BarangMasukController::class, 'index'])->name('barang-masuk');
        Route::get('/create', [BarangMasukController::class, 'create'])->name('barang-masuk.create');
        // Route::get('/edit/{id}', [BarangMasukController::class, 'edit'])->name('barang-masuk.edit');
        Route::post('/', [BarangMasukController::class, 'store'])->name('barang-masuk.store');
        // Route::post('/update/{id}', [BarangMasukController::class, 'update'])->name('barang-masuk.update');
        // Route::get('/delete/{id}', [BarangMasukController::class, 'delete'])->name('barang-masuk.delete');
    });
    
    Route::prefix('pembelian-perlengkapan')->group(function () {
        Route::get('/', [PembelianPerlengkapanController::class, 'index'])->name('pembelian-perlengkapan');
        Route::get('/create', [PembelianPerlengkapanController::class, 'create'])->name('pembelian-perlengkapan.create');
        Route::get('/edit/{id}', [PembelianPerlengkapanController::class, 'edit'])->name('pembelian-perlengkapan.edit');
        Route::post('/', [PembelianPerlengkapanController::class, 'store'])->name('pembelian-perlengkapan.store');
        Route::post('/update/{id}', [PembelianPerlengkapanController::class, 'update'])->name('pembelian-perlengkapan.update');
        Route::get('/delete/{id}', [PembelianPerlengkapanController::class, 'delete'])->name('pembelian-perlengkapan.delete');
    });
    
    Route::prefix('laporan')->group(function () {
        Route::get('/laba-rugi', [LaporanController::class, 'laba_rugi'])->name('laporan.laba-rugi');
        Route::get('/transaksi-harian', [LaporanController::class, 'transaksi_harian'])->name('laporan.transaksi-harian');
        Route::get('laba-rugi/export-pdf', [LaporanController::class, 'laba_rugi_pdf'])->name('laporan.laba-rugi.export-pdf');
        Route::get('laporan-pengiriman/export-pdf', [LaporanController::class, 'data_pengiriman_pdf'])->name('laporan.pengiriman.export-pdf');
        Route::get('laporan-pemasukkan/export-pdf', [LaporanController::class, 'data_pemasukkan_pdf'])->name('laporan.pemasukkan.export-pdf');
        Route::get('laporan-pengeluaran/export-pdf', [LaporanController::class, 'data_pengeluaran_pdf'])->name('laporan.pengeluaran.export-pdf');
    });

    Route::prefix('customer')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
        Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::post('/', [CustomerController::class, 'store'])->name('customers.store');
        Route::post('/update/{id}', [CustomerController::class, 'update'])->name('customers.update');
        Route::get('/delete/{id}', [CustomerController::class, 'delete'])->name('customers.delete');
        Route::post('/add-credit', [CustomerController::class, 'addCredit'])->name('customers.addCredit');
        Route::get('/history-credit/{id}', [CustomerController::class, 'history_limit'])->name('customers.historyLimit');
        Route::post('/add-diskon', [CustomerController::class, 'addDiskon'])->name('customers.addDiskon');
        Route::get('/approval/{id}', [CustomerController::class, 'approval_customer'])->name('customers.approval');
        Route::get('/non-aktif/{id}', [CustomerController::class, 'nonaktif_customer'])->name('customers.non-aktif');
    });
   
    Route::prefix('invoice')->group(function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
        Route::get('/export-pdf', [InvoiceController::class, 'export_pdf'])->name('invoice.export-pdf');
        Route::get('/bukti-terima-pdf', [InvoiceController::class, 'bukti_terima_pdf'])->name('bukti-terima.export-pdf');
    });

    Route::prefix('invoices')->group(function () {
        Route::get('/all', [InvoiceController::class, 'all_invoices'])->name('invoices.index');
        Route::get('/create', [InvoiceController::class, 'createInvoice'])->name('invoices.create');
        Route::get('/generate', [InvoiceController::class, 'generateInvoice'])->name('invoices.generate');
        Route::get('/detail/{id}', [InvoiceController::class, 'detail'])->name('invoices.detail');
        Route::get('/invoice-pdf/{id}/{invoiceId}', [InvoiceController::class, 'generateInvoicePdf'])->name('invoice.customer-pdf');
        Route::post('/invoice/handle-transactions/{id}/{invoiceId}', [InvoiceController::class, 'handleInvoiceTransactions'])->name('invoice.handle-transactions');
        Route::post('/send-wa', [InvoiceController::class, 'send_wa_invoice'])->name('invoice.send-wa');
        Route::post('/send-email', [InvoiceController::class, 'send_email_invoice'])->name('invoice.send-email');
        Route::post('/test-wa', [InvoiceController::class, 'test_wa'])->name('invoice.test-wa');
        Route::get('/invoices/hasil-generate/{id}/{invoiceId}', [InvoiceController::class, 'hasil_transaksi'])->name('invoice.hasil-transaksi');
        Route::post('/all/transaksi-pembayaran', [InvoiceController::class, 'pembayaran_invoice'])->name('invoice.transaksi-pembayaran');
        Route::get('/detail/{invoiceId}/transaksi-pembayaran', [InvoiceController::class, 'detail_riwayat_invoices'])->name('invoice.transaksi-pembayaran.detail');
    });
    
    Route::prefix('penukaran-point')->group(function () {
        Route::get('/', [PenukaranPointController::class, 'index'])->name('penukaran-point');
        Route::post('/', [PenukaranPointController::class, 'proses_penukaran'])->name('proses-penukaran-point');
        Route::get('/list', [PenukaranPointController::class, 'list_penukaran'])->name('list-penukaran-point');
    });

    Route::prefix('posisi-cash')->group(function() {
        Route::get('/', [CashController::class, 'index'])->name('posisi-cash');
        Route::get('/history-pengeluaran', [CashController::class, 'history_pengeluaran'])->name('posisi-cash.history-pengeluaran');
        Route::get('/export/history-pengeluaran', [CashController::class, 'export_pengeluaran'])->name('posisi-cash.export-pengeluaran');
        Route::get('/history-pemasukan', [CashController::class, 'history_pemasukan'])->name('posisi-cash.history-pemasukan');
        Route::get('/export/history-pemasukan', [CashController::class, 'export_pemasukan'])->name('posisi-cash.export-pemasukan');
        Route::get('/history-saldo', [CashController::class, 'history_saldo'])->name('posisi-cash.history-saldo');
        Route::get('/export/history-saldo', [CashController::class, 'export_saldo'])->name('posisi-cash.export-saldo');
        Route::post('/pemasukan', [CashController::class, 'pemasukan_cash'])->name('posisi-cash.pemasukan');
        Route::post('/pengeluaran', [CashController::class, 'pengeluaran_cash'])->name('posisi-cash.pengeluaran');
        Route::post('/closing-saldo', [CashController::class, 'closing_cash'])->name('posisi-cash.closing');
        Route::get('/approve/{id}', [CashController::class, 'approve'])->name('posisi-cash.approve');
        Route::post('/approve-selected', [CashController::class, 'approveSelected'])->name('posisi-cash.approveSelected');
    });

    Route::prefix('pengeluaran-cash')->group(function() {
        Route::get('/', [CashController::class, 'data_pengeluaran_cash'])->name('pengeluaran-cash');
    });
    
    Route::prefix('tagihan-customer')->group(function() {
        Route::get('/', [DashboardController::class, 'tagihan'])->name('tagihan-customer');
    });

    Route::prefix('invoice-customer')->group(function() {
        Route::get('/', [DashboardController::class, 'invoice'])->name('invoice-customer');
    });

    Route::prefix('resi-customer')->group(function() {
        Route::get('/', [DashboardController::class, 'lacak_resi'])->name('resi-customer');
    });

    Route::prefix('point-customer')->group(function() {
        Route::get('/', [DashboardController::class, 'point'])->name('point-customer');
    });

    Route::get('user-level', [UserController::class, 'listLevel'])->name('level');

    Route::get('testing', [TestingController::class, 'index']);
});