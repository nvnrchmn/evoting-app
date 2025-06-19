<?php

use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\ElectionController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Voter\ElectionListController;
use App\Http\Controllers\Voter\VotingController;
use App\Models\Vote;
use Illuminate\Support\Facades\Route;

// Public Route
Route::get('/', fn() => view('welcome'));

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('candidates', CandidateController::class);
    Route::resource('elections', ElectionController::class);
    Route::resource('groups', GroupController::class);

    Route::put('groups/{group}/members', [GroupController::class, 'updateMembers'])->name('groups.members.update');

    // Tes dekripsi
    Route::get('/decrypt/{vote}', function (Vote $vote) {
        return \App\Helpers\RSAHelper::decryptWithPrivateKey($vote->encrypted_vote);
    });
});

// Voter Routes
Route::middleware(['auth', 'voter'])->prefix('voter')->name('voter.')->group(function () {
    Route::get('/voting', [VotingController::class, 'index'])->name('voting.index');                     // List election yg bisa diikuti
    Route::get('/voting/{election}', [VotingController::class, 'show'])->name('voting.show');            // Detail dan form voting
    Route::post('/voting', [VotingController::class, 'vote'])->name('voting.vote');                      // Submit voting
    Route::get('/receipt/{vote}', [VotingController::class, 'downloadReceipt'])->name('voting.receipt'); // PDF
    Route::get('/result/{vote}', [VotingController::class, 'verify'])->name('voting.verifikasi');        // QR verify
    Route::get('/elections', [ElectionListController::class, 'index'])->name('elections.index');
});

// Optional public/semipublic (kalau diperlukan)
Route::get('/hasil-voting/{vote}', function (Vote $vote) {
    return view('voter.voting.qr-result', [
        'vote'      => $vote,
        'candidate' => $vote->candidate,
        'election'  => $vote->election,
    ]);
})->name('voting.qr.result');

Route::get('/verifikasi-voting/{vote}', function (Vote $vote) {
    return view('voter.voting.verifikasi', [
        'vote'      => $vote,
        'user'      => $vote->user,
        'election'  => $vote->election,
        'candidate' => $vote->candidate,
    ]);
})->name('voter.voting.verifikasi.public');

// Auth routes
require __DIR__ . '/auth.php';
