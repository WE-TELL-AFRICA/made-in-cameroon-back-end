<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    public function index(){
        $images = Image::all();
        return response()->json($images, 404);
    }


    public function create(Request $request){
        // Valider les données de la requête
        $request->validate([
            'url_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'product_id'  => '',
            'source' =>'',
        ]);
        // Vérifier si un fichier a été téléchargé
        if ($request->hasFile('url_image')) {
            // Obtenir le fichier téléchargé
            $image = $request->file('url_image');
            // Générer un nom de fichier unique
            $imageName ="";
            if($request->source != null){
            $imageName = $request->source.'-'.time().'_'.$image->getClientOriginalName();
            }else{
                $imageName = time().'_'.$image->getClientOriginalName();
            }
            // Déplacer le fichier vers le dossier de stockage
            if($request->product_id != null){

                $path = 'images/product/' . $request->product_id;
                $image->move(public_path($path), $imageName);
            }else{
                $image->move(public_path('images'), $imageName);
            }
            // Enregistrer le nom du fichier dans la base de données
            $newImage = new Image();
            $newImage->url_image = $imageName;
            if($request->product_id != null){
                $newImage->product_id = $request->product_id;}
            $newImage->save();

            if($request->source != null){
                return $newImage->id;
            }
            // Retourner une réponse réussie
            return response()->json(['message' => 'success', 'image' => $newImage], 200);
        }
        // Retourner une réponse d'erreur si aucun fichier n'a été téléchargé
        return response()->json(['message' => 'Echec aucun fichier sélectionné'], 400);
    }
    public function createMulti(Request $request){

        $request->validate([
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'product_id'  => '',
        ]);

    $images = $request->image;
    $imageNames = [];
    foreach ($images as $image) {
        $imageName = time().'_'.$image->getClientOriginalName();
        $path = 'images/';
        $image->move(public_path($path), $imageName);
        $imageNames[] = $imageName;
        $newImage = new Image();
        $newImage->url_image = $imageName;
        if($request->product_id != null){
        $newImage->product_id = $request->product_id;
        }
        $newImage->save();
    }

    return response()->json(['message' => 'success', 'imageName'=> $imageNames ], 200);
}

public function delete($id)
{
    $image = Image::find($id);

    if ($image) {

        $image->delete();
        return response()->json(
            ['image' => $image,
        'message' => 'delete'
    ], 200);

    } else {
        return response()->json([
        'message' => "L'image n'existe pas"
    ], 404);
    }

}

public function deleteAll(){
    Image::truncate();
    return response()->json( ['message' => 'all images delete'], 200);
}

}

