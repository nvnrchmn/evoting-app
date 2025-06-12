<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Voter\VotingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('candidates', \App\Http\Controllers\Admin\CandidateController::class);
});

Route::middleware(['auth', 'voter'])->prefix('voter')->name('voter.')->group(function () {
    Route::get('/voting', [VotingController::class, 'index'])->name('voting.index');
    Route::post('/voting', [VotingController::class, 'vote'])->name('voting.vote');
});

Route::get('/voting/receipt/{vote}', [VotingController::class, 'downloadReceipt'])->name('voting.receipt');

Route::get('/admin/decrypt/{vote}', function (\App\Models\Vote $vote) {
    return \App\Helpers\RSAHelper::decryptWithPrivateKey($vote->encrypted_vote);
});
