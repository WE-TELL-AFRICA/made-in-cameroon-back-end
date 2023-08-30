<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::with('imageCover')->get();
        return response()->json([
            'message' => 'success',
            'list_categories' => $categories], 200);
    }


    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'parent_id' => '',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096'
        ]);

        if($request->image !=null){
            $imageController = new ImageController();
            $newRequest = new Request();
            $newRequest->files->set('url_image', $request->image);
            $newRequest->merge(['source' => "categorie"]);
            $createdImageId = $imageController->create($newRequest);
            $category = new Category();
        
            $category->cover_image_id = $createdImageId;
            $category->name = $request->input('name');
            if($request->parent_id !=null){
                $category->parent_id = $request->parent_id;
            }
            $category->save();
            return response()->json(['message' => 'catégorie créer','category' => $category], 201);
        }else{

            $category = new Category();
            $category->name = $request->input('name');
            if($request->parent_id !=null){
                $category->parent_id = $request->parent_id;
            }
            $category->save();
            return response()->json(['message' => 'catégorie créer','category' => $category], 201);
        }
    }

    public function deleteAll(){
        Category::truncate();
        return response()->json( ['message' => 'all categories delete'], 200);
    }


}
