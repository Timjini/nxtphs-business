<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\Admin\NotificationHubController;
use App\Http\Controllers\Admin\CampController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');

    // Camp Management
    Route::prefix('camps')->group(function(){
        Route::get('/', [CampController::class, 'index'])->name('admin.camps.index');
    });
    // Accounts Management
    Route::prefix('accounts')->group(function(){
        Route::get('/', [AccountController::class, 'index'])->name('admin.accounts.index');
    });
    // Notification Hub
    Route::prefix('notifications-hub')->group(function(){
        Route::get('/', [NotificationHubController::class, 'index'])->name('admin.notifications-hub.index');
    });
    // Billing Management
    Route::prefix('billing')->group(function(){
        Route::get('/', [BillingController::class, 'index'])->name('admin.billing.index');
    });
});
