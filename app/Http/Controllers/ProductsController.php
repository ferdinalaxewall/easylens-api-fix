<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Resources\ProductsCollection;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $products = new ProductsCollection(Products::all());
            return response()->json($products, 200);
        }catch(\Exception $error){
            return response()->json(["message" => $error], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imageName = md5(time().'_'.$request->file('file')->getRealPath());
        $imageExtension = $request->file('file')->guessExtension();
        $finalImage = $imageName.'.'.$imageExtension;
        try{
            $saveProduct = Products::create([
                "name" => $request->name,
                "category" => $request->category,
                "description" => $request->description,
                "lite" => $request->lite,
                "medium" => $request->medium,
                "large" => $request->large,
                "image" => $finalImage,
            ]);

            $request->file('file')->move(public_path("product-images"), $finalImage);

            return response()->json("Successfully Created Product!", 200);
        }catch(\Error $error){
            return response()->json(['message' => $error], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $products = Products::where('id', $id)->first();
            return response()->json($products, 200);
            
        }catch(\Error $error){  
            return response()->json(['message' => $error], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Products::where('id', $id)->first();
         
        $finalImage = $product->image;
        if($request->file('file') != null){
            $imageName = md5(time().'_'.$request->file('file')->getRealPath());
            $imageExtension = $request->file('file')->guessExtension();
            $finalImage = $imageName.'.'.$imageExtension;
        }

        try{
            $updateProduct = Products::where('id', $id)->update([
                "name" => $request->name,
                "category" => $request->category,
                "description" => $request->description,
                "lite" => $request->lite,
                "medium" => $request->medium,
                "large" => $request->large,
                "image" => $finalImage,
            ]);

            if($request->file('file') != null){
                $request->file('file')->move(public_path("product-images"), $finalImage);
                
                if(File::exists(public_path('product-images/'.$product->image))){
                    File::delete(public_path('product-images/'.$product->image));
                }
            }

            return response()->json("Successfully Updated Product!", 200);
        }catch(\Error $error){
            return response()->json(['message' => $error], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::where('id', $id)->first();
        try{
            if(File::exists(public_path('product-images/'.$product->image))){
                File::delete(public_path('product-images/'.$product->image));
            }

            Products::where('id', $id)->delete();

            return response()->json(['message' => 'Successfully Deleted Product!'], 200);
        }catch(\Error $error){
            return response()->json(['message' => $error], 500);
        }
    }
}
