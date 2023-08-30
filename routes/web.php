<?php

use App\Models\Category;
use App\Models\Product;
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

Route::get('/create', function () {
    $product = new Product();
    $product->name = "Jus de fruits par banaloba compagny";
    $product->description = "Meilleur jus de fruits jamais fabriqué au Cameroun";
    $product->category_id = 1;
    $product->is_approve = true;
    $product->save();
});

Route::get('/read', function () {

    $products = Product::all();

    foreach ($products as $product){
        echo $product->is_approve;

        echo("<br/>");
        if($product->is_approve){
            echo("is true");
        }else{
            echo("is false");
        }

        echo("<br/>");
        echo("************");
        echo("<br/>");
    }


});



