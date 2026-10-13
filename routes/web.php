<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfileController;

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/how-it-works', [App\Http\Controllers\HomeController::class, 'howItWorks'])->name('how_it_works');
Route::get('/investment-batches', [App\Http\Controllers\HomeController::class, 'investmentBatches'])->name('investment_batches');
Route::get('/portfolio', [App\Http\Controllers\HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/privacy-policy', [App\Http\Controllers\HomeController::class, 'privacyPolicy'])->name('privacy');
Route::get('/terms-of-service', [App\Http\Controllers\HomeController::class, 'termsOfService'])->name('terms');

// Auth Routes
Auth::routes();

// --- User Dashboard & Actions ---
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [BatchController::class, 'index'])->name('dashboard');
    Route::post('/batch/{id}/join', [BatchController::class, 'joinBatch'])->name('batch.join');
    Route::post('/wallet/deposit', [WalletController::class, 'deposit'])->name('wallet.deposit');
    Route::post('/wallet/withdraw', [WalletController::class, 'withdraw'])->name('wallet.withdraw');

    // User My Batches Page
    Route::get('/my-batches', [BatchController::class, 'myBatches'])->name('user.batches');

    // User Wallet & Transactions Page
    Route::get('/wallet', [WalletController::class, 'myWallet'])->name('user.wallet');

    // User Settings Profile & Password
    Route::get('/settings', [ProfileController::class, 'settings'])->name('user.settings');
    Route::post('/settings/profile', [ProfileController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/settings/password', [ProfileController::class, 'updatePassword'])->name('user.password.update');
});



// --- Admin Routes ---
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/finance/add', [AdminController::class, 'addFinance'])->name('admin.finance.add');
    Route::post('/admin/profit/distribute/{batch_id}', [AdminController::class, 'distributeProfit'])->name('admin.profit.distribute');
    Route::get('/admin/deposits', [AdminController::class, 'pendingDeposits'])->name('admin.deposits');
    Route::post('/admin/deposit/{id}/approve', [AdminController::class, 'approveDeposit'])->name('admin.deposit.approve');
    Route::post('/admin/deposit/{id}/reject', [AdminController::class, 'rejectDeposit'])->name('admin.deposit.reject');

    // Batch Management
    Route::get('/admin/batches', [AdminController::class, 'manageBatches'])->name('admin.batches');
    Route::post('/admin/batches/store', [AdminController::class, 'storeBatch'])->name('admin.batches.store');
    Route::post('/admin/batches/{id}/status', [AdminController::class, 'updateBatchStatus'])->name('admin.batches.status');

    // নতুন যুক্ত করা রাউট (Edit & Delete)
    Route::post('/admin/batches/{id}/update', [AdminController::class, 'updateBatch'])->name('admin.batches.update');
    Route::post('/admin/batches/{id}/delete', [AdminController::class, 'deleteBatch'])->name('admin.batches.delete');

    // Project Management
    Route::get('/admin/projects', [AdminController::class, 'manageProjects'])->name('admin.projects');
    Route::post('/admin/projects/{id}/status', [AdminController::class, 'updateProjectStatus'])->name('admin.projects.status');

    // P&L Management
    Route::get('/admin/finances', [AdminController::class, 'manageFinances'])->name('admin.finances');
    Route::post('/admin/finances/{id}/delete', [AdminController::class, 'deleteFinance'])->name('admin.finance.delete');

    // Profit Distribution Page
    Route::get('/admin/profit-distributions', [AdminController::class, 'profitDistributions'])->name('admin.profit.index');

    // User Management
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::post('/admin/users/{id}/update', [AdminController::class, 'updateUser'])->name('admin.users.update');

    Route::get('/admin/withdrawals', [AdminController::class, 'pendingWithdrawals'])->name('admin.withdrawals');
    Route::post('/admin/withdrawal/{id}/approve', [AdminController::class, 'approveWithdrawal'])->name('admin.withdrawal.approve');
    Route::post('/admin/withdrawal/{id}/reject', [AdminController::class, 'rejectWithdrawal'])->name('admin.withdrawal.reject');

    Route::get('/admin/site-settings', [AdminController::class, 'siteSettings'])->name('admin.settings');
    Route::post('/admin/site-settings', [AdminController::class, 'updateSiteSettings'])->name('admin.settings.update');

    Route::get('/admin/testimonials', [AdminController::class, 'testimonials'])->name('admin.testimonials');
    Route::post('/admin/testimonials', [AdminController::class, 'storeTestimonial'])->name('admin.testimonials.store');
    Route::post('/admin/testimonials/{id}/delete', [AdminController::class, 'deleteTestimonial'])->name('admin.testimonials.delete');
});
