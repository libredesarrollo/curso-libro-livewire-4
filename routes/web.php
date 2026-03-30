<?php

use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::view('/', 'welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::prefix('{current_team}')
    ->middleware(['auth', 'verified', EnsureTeamMembership::class])
    ->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
    });

Route::middleware(['auth'])->group(function () {
    Route::livewire('invitations/{invitation}/accept', 'pages::teams.accept-invitation')->name('invitations.accept');
    Route::group(['prefix' => 'dashboard'], function ()  {
        Route::group(['prefix' => 'category'], function ()  {
            Route::livewire('', 'pages::dashboard.category.index')->name('d-category-index');
            Route::livewire('create', 'pages::dashboard.category.save')->name('d-category-create');
            Route::livewire('edit/{id}', 'pages::dashboard.category.save')->name('d-category-edit');
        });
        Route::group(['prefix' => 'post'], function ()  {
            Route::livewire('', 'pages::dashboard.post.index')->name('d-post-index');
            Route::livewire('create', 'pages::dashboard.post.save')->name('d-post-create');
            Route::livewire('edit/{id}', 'pages::dashboard.post.save')->name('d-post-edit');
        });
        Route::group(['prefix' => 'tag'], function ()  {
            Route::livewire('', 'pages::dashboard.tag.index')->name('d-tag-index');
            Route::livewire('create', 'pages::dashboard.tag.save')->name('d-tag-create');
            Route::livewire('edit/{id}', 'pages::dashboard.tag.save')->name('d-tag-edit');
        });
    });
});


require __DIR__.'/settings.php';
