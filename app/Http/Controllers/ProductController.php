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
        // if(request()->ajax()) {
        //     return datatables()->of(Product::select('*'))
        //     ->addColumn('action', 'product-button')
        //     ->addColumn('image', 'image')
        //     ->rawColumns(['action','image'])
        //     ->addIndexColumn()
        //     ->make(true);
        // } 
        // return view('products.index');
        // if ($request->ajax()) {
        //     $data = Product::latest()->get();
        //     return Datatables::of($data)
        //             ->addIndexColumn()
        //             ->addColumn('action', function($row){
   
        //                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
     
        //                     return $btn;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
        // }


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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
     
        $productId = $request->product_id;
     
        $details = ['name' => $request->name, 'type' => $request->type, 'details' => $request->details];
     
        if ($image = $request->file('thumbnail')) {
                $destinationPath = 'images/';
                $filenamewithExt = $image->getClientOriginalName();
                $fileName = pathinfo($filenamewithExt, PATHINFO_FILENAME);
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $filenameToStore = $fileName.'_'.time().'.'.$extension;
                $image->move($destinationPath, $filenameToStore);
                $request->thumbnail = "$filenameToStore";
        }
        $product   =   Product::updateOrCreate(['id' => $productId], $details);  
               
        return Response()->json($product);


    // return response understanding





        // $request->validate([
        //     'name' => 'required',
        //     'type' => 'required',
        //     'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'details' => 'required',
        // ]);
        // $product = new Product();
        // $product->user_id = 1;
        // $product->name = $request->name;
        // $product->type = $request->type;
        
        // $request['user_id'] = 1;
        // if ($image = $request->file('thumbnail')) {
        //     $destinationPath = 'images/';
        //     $filenamewithExt = $image->getClientOriginalName();
        //     $fileName = pathinfo($filenamewithExt, PATHINFO_FILENAME);
        //     $extension = $request->file('thumbnail')->getClientOriginalExtension();
        //     $filenameToStore = $fileName.'_'.time().'.'.$extension;
        //     $image->move($destinationPath, $filenameToStore);
        //     $product->thumbnail = "$filenameToStore";
        // }
        // $product->details = $request->details;
        // $product->save();
        
        // return redirect()->back();
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
        $where = array('id' => $id);
        $product  = Product::where($where)->first();
    
        return Response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
     
        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
