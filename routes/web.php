<?php

use App\Mail\WelcomeMail;
use App\Models\Rekap_data;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RekapDataController;
use App\Http\Controllers\DataSupplierController;
use App\Http\Controllers\NorekController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\Profil;
use App\Models\Norek;
use App\Models\Penjualan;

Route::get('/', [App\Http\Controllers\AuthController::class, 'index'])->name('login');

Route::post('/proses/login', [App\Http\Controllers\AuthController::class, 'login'])->name('proses.login');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/forgot', function () {
    return view('auth.forgot');
})->middleware('guest')->name('forgot.password');

Route::post('/forgot', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with('status', __($status))
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PasswordReset
        ? redirect()->route('login')->with(['success' => 'Password berhasil diubah'], 'status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::middleware(['auth'])->group(function () {

    Route::get('/profil', [App\Http\Controllers\Profil::class, 'index'])->name('profil');
    Route::post('/ubah-profil', [Profil::class, 'uploadPhoto'])->name('ubah-profil');
    Route::put('/admin/change-norek/{id}', [NorekController::class, 'changeNorek'])->name('cn-norek');
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/kategori', [App\Http\Controllers\KategoriController::class, 'index'])->name('admin.kategori');
    Route::post('/admin/kategori/store', [App\Http\Controllers\KategoriController::class, 'store'])->name('kategori.store');
    Route::put('/admin/kategori/update/{id_kategori}', [App\Http\Controllers\KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/admin/kategori/delete/{id_kategori}', [App\Http\Controllers\KategoriController::class, 'destroy'])->name('Kategori.destroy');
    Route::delete('/admin/supplier/delete/{kode_supplier}', [App\Http\Controllers\DataSupplierController::class, 'destroy'])->name('supplier.destroy');

    Route::get('/admin/data_supplier', [App\Http\Controllers\DataSupplierController::class, 'index'])->name('data_supplier.index');
    Route::post('/admin/data_supplier/store', [App\Http\Controllers\DataSupplierController::class, 'store'])->name('data_supplier.store');
    Route::put('/admin/data_supplier/update/{id_supplier}', [App\Http\Controllers\DataSupplierController::class, 'update'])->name('data_supplier.update');
    Route::delete('/admin/data_supplier/delete/{id_supplier}', [App\Http\Controllers\DataSupplierController::class, 'destroy'])->name('data_supplier.destroy');

    Route::get('/admin/data_barang', [App\Http\Controllers\DataBarangController::class, 'index'])->name('data_barang.index');
    Route::post('/admin/data_barang/store', [App\Http\Controllers\DataBarangController::class, 'store'])->name('data_barang.store');
    Route::put('/admin/data_barang/update/{id_barang}', [App\Http\Controllers\DataBarangController::class, 'update'])->name('data_barang.update');
    Route::delete('/admin/data_barang/delete/{id_barang}', [App\Http\Controllers\DataBarangController::class, 'destroy'])->name('data_barang.destroy');
    Route::get('/admin/data_barang/show/{id_barang}', [App\Http\Controllers\DataBarangController::class, 'show'])->name('data_barang.show');

    Route::get('/admin/barang_masuk', [App\Http\Controllers\BarangMasukController::class, 'index'])->name('barang_masuk.index');
    Route::post('/admin/barang_masuk/store', [App\Http\Controllers\BarangMasukController::class, 'store'])->name('barang_masuk.store');
    Route::delete('/admin/barang_masuk/delete/{id_barang_masuk}', [App\Http\Controllers\BarangMasukController::class, 'destroy'])->name('barang_masuk.destroy');

    Route::resource('/admin/penjualan', PenjualanController::class);
    Route::get('/cetak_nota/{id}', [PenjualanController::class, 'cetak_nota'])->name('cetak_nota');

    Route::get('/admin/barang_keluar', [App\Http\Controllers\BarangKeluarController::class, 'index'])->name('barang_keluar.index');
    Route::post('/admin/barang_keluar/store/{id}', [App\Http\Controllers\BarangKeluarController::class, 'storeDetail'])->name('detail_penjualan.store');
    Route::delete('/admin/barang_keluar/delete/{id_barang_keluar}', [App\Http\Controllers\BarangKeluarController::class, 'destroy'])->name('barang_keluar.destroy');

    Route::get('/admin/rekap_data', [App\Http\Controllers\RekapDataController::class, 'index'])->name('rekap_data.index');
    Route::post('/admin/rekap_data/store', [App\Http\Controllers\RekapDataController::class, 'store'])->name('rekap_data.store');
    
    Route::get('/admin/rekap_data', [App\Http\Controllers\RekapDataController::class, 'index'])->name('rekap.index');
    Route::delete('/admin/rekap_data/harian/{tanggal}', [RekapDataController::class, 'hapusHarian'])->name('rekap_data.hapus_harian');

    Route::get('/admin/rekap_data/print-harian', [RekapDataController::class, 'cetakHarian'])->name('rekap_data.print.harian');
    Route::get('/admin/rekap_data/print-bulanan', [RekapDataController::class, 'cetakBulanan'])->name('rekap.cetak_bulanan');
    Route::get('/admin/rekap_data/print-tahunan', [RekapDataController::class, 'cetakTahunan'])->name('rekap.cetak_tahunan');
    Route::post('/admin/rekap_data/simpan-harian', [RekapDataController::class, 'simpanHarian'])->name('rekap_data.simpan_harian');
});

Route::get('/send-welcome-mail', function () {
    $data = [
        'email' => 'terserah@gmail.com',
        'password' => 123
    ];
    Mail::to('aaa@gmail.com')->send(new WelcomeMail($data));
});