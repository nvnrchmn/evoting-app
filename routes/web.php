<?php

use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\ElectionController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Voter\VotingController;
use App\Models\Vote;
use Illuminate\Support\Facades\Route;

// Public Route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('candidates', CandidateController::class);
    Route::resource('elections', ElectionController::class);
    Route::resource('groups', GroupController::class);
    Route::get('/decrypt/{vote}', function (Vote $vote) {
        return \App\Helpers\RSAHelper::decryptWithPrivateKey($vote->encrypted_vote);
    });
});

// Voter Routes
Route::middleware(['auth', 'voter'])->prefix('voter')->name('voter.')->group(function () {
    Route::get('/voting', [VotingController::class, 'index'])->name('voting.index');
    Route::post('/voting', [VotingController::class, 'vote'])->name('voting.vote');
    Route::get('/elections', function () {
        return view('voter.elections.index');
    })->name('elections.index');
    Route::get('/voting/{election}', [VotingController::class, 'index'])->name('voting.index');
});

// Voting Receipt & Verification (Public or Mixed Access)
Route::get('/voting/receipt/{vote}', [VotingController::class, 'downloadReceipt'])->name('voting.receipt');
Route::get('/voting/result/{vote}', [VotingController::class, 'verify'])
    ->middleware('auth')
    ->name('voting.result.qr');

// Optional Public Display or Verification
Route::get('/hasil-voting/{vote}', function (Vote $vote) {
    $candidate = $vote->candidate;
    $election  = $vote->election;
    return view('voter.voting.qr-result', compact('vote', 'candidate', 'election'));
})->name('voting.qr.result');

Route::get('/verifikasi-voting/{vote}', function (Vote $vote) {
    $user      = $vote->user;
    $election  = $vote->election;
    $candidate = $vote->candidate;
    return view('voter.voting.verifikasi', compact('vote', 'user', 'election', 'candidate'));
})->name('voter.voting.verifikasi');

Route::put('groups/{group}/members', [GroupController::class, 'updateMembers'])->name('admin.groups.members.update');

require __DIR__ . '/auth.php';
