<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function userCan($action, $option = NULL)
    {
        $user = Auth::user();
        return Gate::forUser($user)->allows($action, $option);
    }

    public function index()
    {
        $allproducts = Product::orderBy('product_id', 'desc')->get();
        $allmanus = Manufacturer::all();
        return view('admin.products', [
            'allproducts' => $allproducts,
            'allmanus' => $allmanus,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        $allmanus = Manufacturer::all();
        return view('admin.addproduct', [
            'allmanus' => $allmanus,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allmanus = Manufacturer::all();
        $product = Product::where('product_id', $id)->first();
        return view('admin.editproduct', [
            'allmanus' => $allmanus,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Cap nhat san pham
    public function update(Request $request, $id)
    {
        
        $product = Product::find($id);
        $product->manu_id = $request->manu_id;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        if ($request->file('image') != null) {
            $product->image = $request->file('image')->getClientOriginalName();
            $request->file('image')->move('img', $request->file('image')->getClientOriginalName(), 'local');
        }
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->feature = $request->feature;
        $product->sale = $request->sale;
        $product->star = $request->star;
        $product->created_at = $request->created_at;
        $product->save();
        return redirect()->action([ProductsController::class, 'index']);
    }

    public function store(Request $request)
    {
        $product = new Product;
        $product->manu_id = $request->manu_id;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->image = $request->file('image')->getClientOriginalName();
        $request->file('image')->move('img', $request->file('image')->getClientOriginalName(), 'local');
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->feature = $request->feature;
        $product->sale = $request->sale;
        $product->star = $request->star;
        $product->created_at = $request->created_at;
        $product->save();
        return redirect()->action([ProductsController::class, 'index']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $product = Product::find($id);
        $product->delete();
        return redirect()->action([ProductsController::class, 'index']);
    }
}
