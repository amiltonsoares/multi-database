<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', 'Tenant\\TenantController@index')->name('tenant.index');
Route::get('/', function () {
    return redirect()->route('tenant.index');
});
Route::get('tenant/', 'Tenant\\TenantController@index')->name('tenant.index');
Route::get('tenant/create', 'Tenant\TenantController@create')->name('tenant.create');
Route::post('tenant', 'Tenant\TenantController@store')->name('tenant.store');
Route::get('tenant/{domain}', 'Tenant\TenantController@show')->name('tenant.show');
Route::get('tenant/edit/{domain}', 'Tenant\TenantController@edit')->name('tenant.edit');
Route::put('tenant/{id}', 'Tenant\TenantController@update')->name('tenant.update');
Route::delete('tenant/{id}', 'Tenant\TenantController@destroy')->name('tenant.destroy');
