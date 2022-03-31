<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            "message" => "Products",
            "data" => product::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required",
            'details'=>"required"
        ]);
        $product = product::create([
            'name' => $request->name,
            'details' => $request->details
        ]);
        return response()->json([
            'success' => true,
            "message" => "Product Created Successfully!",
            "data" =>  $product
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = product::find($id);
        if ($product) {
            return response()->json([
                "success" => true,
                "message" => "Product",
                "data" => $product
            ]);
        }
        return response()->json([
            "success" => false,
            "message" => "Product Not Found!",
            "data" => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>"required",
            "details"=>"required"
        ]);
        $product = product::find($id);
        if ($product) {
            $product->name=$request->name;
            $product->details=$request->details;
            $product->save();
            return response()->json([
                'success' => true,
                "message" => "Product Updated Successfully!",
                "data" => $product
            ]);
        }
        return response()->json([
            'success' => false,
            "message" => "Product Does Not Updated!",
            "data" => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::find($id);

        if($product){
            $product->delete();
            return response()->json([
                'success' => true,
                "message" => "Product Deleted Successfully!",
                "data" => $product
            ]);
        }
        return response()->json([
            'success' =>false,
            "message" => "Product Does Not Deleted!",
            "data" => $product
        ]);
    }
}
