<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Models\Product;

class ManufacturersController extends Controller
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
        $allmanus = Manufacturer::all();
        $allproducts = Product::all();
        return view('admin.manufacturers', [
            'allmanus' => $allmanus,
            'allproducts' => $allproducts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //    return view('admin.addmanufacturer');
    // }

    public function edit($id)
    {
       $manu = Manufacturer::where('manu_id', $id)->first();
        return view('admin.editmanufacturer', [
           'manu' => $manu,
       ]);
    }
    

    public function create()
    {
       return view('admin.addmanufacturer');
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
        $manu = Manufacturer::find($id);
       $manu->manu_name = $request->manu_name;
       $manu->save();
       return redirect()->action([ManufacturersController::class, 'index']);
    }
    public function store(Request $request)
    {
        $manu = new Manufacturer;
        $manu->manu_name = $request->manu_name;
        $manu->save();
        return redirect()->action([ManufacturersController::class, 'index']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy ($id)
    {
       $manu = Manufacturer::find($id);
       $manu->delete();
        return redirect()->action([ManufacturersController::class, 'index']);
    }
}
