<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artisan;
use Illuminate\Http\Request;

class ArtisanController extends Controller
{
    //

    public function deleteAll(){
        Artisan::truncate();
        return response()->json( ['message' => 'all artisans delete'], 200);
    }
}
