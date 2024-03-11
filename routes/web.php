<?php

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

Route::get('/', 'HomeController@home')->name('home');

Route::post('contact', 'HomeController@postContactForm')->name('contact.submit');

Route::post('newsletter', 'HomeController@postNewsletterForm')->name('newsletter.submit');

Route::get('newsletter-all', 'HomeController@subscribeAllOfTable')->name('newsletter.all');

Auth::routes(['register' => false]);

Route::get('encrypt/{data}', 'OptimizationController@__encrypt')->name('enrypt');
Route::get('reseau/inscrire', 'NetworkController@getRegisterForm')->name('network.register');
Route::post('reseau/inscrire', 'NetworkController@postRegisterForm')->name('network.register-store');

Route::middleware(['auth'])->group(function () {
    Route::prefix('espace-membres')->group(function () {
        Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
        Route::prefix('codes')->group(function () {
            Route::get('liste', 'CodeController@indexGeneration')->name('code.list');
            Route::get('generate', 'CodeController@getGenerationForm')->name('code.generate');
            Route::get('miens', 'CodeController@getUserCodes')->name('code.mine');
            Route::get('transferer', 'CodeController@getCodeTransferForm')->name('code.transfer');
            Route::get('transfert-liste', 'CodeController@historyOfCodeTransfer')->name('code.transfer-history');
            Route::post('generate', 'CodeController@postGenerationForm')->name('code.generate-store');
            Route::post('transfer', 'CodeController@postCodeTransferForm')->name('code.transfer-store');
        });
    
        Route::prefix('demande-retrait')->group(function () {
            Route::get('soumettre', 'WithdrawalRequestController@create')->name('withdrawal-request.submit');
            Route::get('traitees', 'WithdrawalRequestController@indexProcessed')->name('withdrawal-request.processed_history');
            Route::get('non-traitees', 'WithdrawalRequestController@indexNotProcessed')->name('withdrawal-request.not_processed_history');
            Route::get('process/{withdrawal_request_id}/{process}', 'WithdrawalRequestController@process')->name('withdrawal-request.process');
            Route::post('soumettre', 'WithdrawalRequestController@store')->name('withdrawal-request.submit-store');
        });
    
        Route::prefix('reseau')->group(function () {
            Route::get('genealogie/{user_id}', 'NetworkController@genealogy')->name('network.genealogy');
            Route::get('changer-mot-de-passe/{which_password}', 'NetworkController@getPasswordChangeForm')->name('network.change-password');
            Route::post('changer-mot-de-passe/{which_password}', 'NetworkController@postPasswordChangeForm')->name('network.change-password-store');
            Route::get('utilisateurs', 'NetworkController@getUsers')->name('network.users');
            Route::get('utilisateurs/{id}/edition', 'NetworkController@edit')->name('network.users.edit');
            Route::put('utilisateurs/update/{id}', 'NetworkController@update')->name('network.users.update');
        });
    
        Route::prefix('optimization')->group(function () {
            Route::get('url', 'OptimizationController@clearRoute')->name('optimization.url');
            Route::get('genealogy', 'OptimizationController@optimizeGenealogy')->name('optimization.genealogy');
            Route::get('view', 'OptimizationController@clearView')->name('optimization.view');
            Route::get('cache', 'OptimizationController@clearCache')->name('optimization.cache');
            Route::get('config', 'OptimizationController@clearConfig')->name('optimization.config');
        });
    
        Route::prefix('leading-group')->group(function () {
            Route::get('list', 'LeadingGroupController@index')->name('leading-group.list');
            Route::get('create', 'LeadingGroupController@create')->name('leading-group.create');
            Route::get('edit/{id}', 'LeadingGroupController@edit')->name('leading-group.edit');
            Route::get('validate/{id}/{active}', 'LeadingGroupController@updateActivity')->name('leading-group.update-activity');
            Route::put('edit/{id}', 'LeadingGroupController@update')->name('leading-group.edit-store');
            Route::post('create', 'LeadingGroupController@store')->name('leading-group.create-store');
        });
    
        Route::prefix('trace')->group(function () {
            Route::get('action', 'MarkController@getMarks')->name('mark.action');
            Route::get('transaction-enregistrements-liste', 'MarkController@getRecordingTransactions')->name('mark.recording-transaction-history');
            Route::get('bonus-liste', 'MarkController@getBonuses')->name('mark.bonuses-history');
        });

        Route::prefix('newsletter')->group(function () {
            Route::get('abonnes', 'NewsletterController@index')->name('newsletter.index');
        });
    });
});
