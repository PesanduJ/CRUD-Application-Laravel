<?php

use App\Http\Controllers\ProductController;     //make sure to import ProductController class
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

Route::get('/', function () {
    return view('welcome');
});


//newly created resource route for product , so laravel will know it will we for all the CRUD operations
Route::resource('products', ProductController::class);
