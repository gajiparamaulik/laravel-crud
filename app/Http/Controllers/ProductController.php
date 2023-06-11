<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $getData = Product::get();
        return view('products.index', compact('getData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illumin ate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'details' => 'required',
        ]);
        $authUser = auth()->user()->id;
        $product = new Product();
        $product->user_id = $authUser;
        $product->name = $request->name;
        $product->type = $request->type;
        
        $request['user_id'] = 1;
        if ($image = $request->file('thumbnail')) {
            $destinationPath = 'images/';
            $filenamewithExt = $image->getClientOriginalName();
            $fileName = pathinfo($filenamewithExt, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $filenameToStore = $fileName.'_'.time().'.'.$extension;
            $image->move($destinationPath, $filenameToStore);
            $product->thumbnail = "$filenameToStore";
        }
        $product->details = $request->details;
        $product->save();
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product  = Product::find($id);   
        return Response()->json([
            'status' => 200,
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $authUser = auth()->user()->id;
        $prod_id = $request->input('prod_id');
        $product = Product::find();
        $product->user_id = $authUser;
        $product->name = $request->input('name');
        $product->type = $request->input('type');
        $product->details = $request->input('details');
        $product->update();
        
        return redirect()->back()->with('status', 'Product update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete(); //delete model
        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
