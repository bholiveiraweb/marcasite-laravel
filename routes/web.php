<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/user/add', 'UserController@add')->name('user.add');
Route::post('/user/register', 'UserController@register')->name('user.register');

Route::get('/customer', 'CustomerController@index')->name('customer.index');
Route::get('/customer/add', 'CustomerController@add')->name('customer.add');
Route::post('/customer/store', 'CustomerController@store')->name('customer.store');
Route::get('/customer/edit/{id}', 'CustomerController@edit')->name('customer.edit');
Route::post('/customer/update/{id}', 'CustomerController@update')->name('customer.update');
Route::get('/customer/delete/{id}', 'CustomerController@delete')->name('customer.delete');

Route::get('/proposal', 'ProposalController@index')->name('proposal.index');
Route::get('/proposal/add', 'ProposalController@add')->name('proposal.add');
Route::post('/proposal/store', 'ProposalController@store')->name('proposal.store');
Route::get('/proposal/edit/{id}', 'ProposalController@edit')->name('proposal.edit');
Route::post('/proposal/update/{id}', 'ProposalController@update')->name('proposal.update');
Route::get('/proposal/delete/{id}', 'ProposalController@delete')->name('proposal.delete');
Route::get('/proposal/load-customer', 'ProposalController@loadCustomer')->name('proposal.load-customer');
Route::get('/proposal/export', 'ProposalController@export')->name('proposal.export');
