<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::where('is_approve', true)->with('images')->paginate(4);
        return response()->json([
            'message' => 'success',
            'list_products' => $products], 200);
    }

    public function show(int $id)
    {
        $product = Product::find($id);
        if($product){
            return response()->json([
                    'message' => 'success',
                    'product' => $product],
                    200);
                }
        return response()->json(['message' => "Le produit n'existe pas"], 404);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'is_approve' => 'required|boolean',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096'
        ]);


        $product = Product::create($validatedData);



        if($request->image !=null){
            $imageController = new ImageController();
            $newRequest = new Request();
            $newRequest->files->set('image', $request->image);
            $newRequest->merge(['product_id' => $product->id]);
            $imageController->createMulti($newRequest);
        }

        return response()->json([
            'message' => 'success',
            'product_id' => $product->id,
            'product' => $product,
    ], 201);
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if ($product) {

            $product->delete();
            return response()->json(
                ['product' => $product,
            'message' => 'delete'
        ], 200);

        } else {
            return response()->json([
            'message' => "Le produit n'existe pas"
        ], 404);
        }

    }

    public function deleteAll(){
        Product::truncate();
        return response()->json( ['message' => 'all products delete'], 200);
    }

}



