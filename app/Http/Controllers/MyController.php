<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Product;
use App\Models\Manufacturer;
use App\Models\User;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

use function GuzzleHttp\Promise\all;

class MyController extends Controller
{
    function userCan($action, $option = NULL)
    {
        $user = Auth::user();
        return Gate::forUser($user)->allows($action, $option);
    }
    function admin()
   {
       if (!$this->userCan('view-page-admin')) {
           abort('404', __('EROR'));
        }
       $allproducts = Product::all();
       $allmanus = Manufacturer::all();
        $allusers = User::all();
       return view('admin.index', [
           'allproducts' => $allproducts,
           'allmanus' => $allmanus,
           'allusers' => $allusers,
      ]);
    }
    // Tim kiem
    function search()
    {
        session()->put('option', request()->option);
        session()->put('key', request()->key);
        $user = Auth::user();
        $allmanus = Manufacturer::all();
        $allproducts = Product::all();
        $topsellings = Product::where('sale', '>', 0)->orderBy('sale', 'desc')->take(3)->get();
        if (request()->option == 'description') {
            $search = Product::where('description', 'like', '%' . request()->key . '%')->paginate(6);
            $allsearchs = Product::where('description', 'like', '%' . request()->key . '%')->get();
        } else if (request()->option == 'product_name') {
            $search = Product::where('product_name', 'like', '%' . request()->key . '%')->paginate(6);
            $allsearchs = Product::where('product_name', 'like', '%' . request()->key . '%')->get();
        } else if (request()->option == 'manu_name') {
            $manus = Manufacturer::where('manu_name', 'like', '%' . request()->key . '%')->first();
            $search = Product::where('manu_id', $manus->manu_id)->paginate(6);
            $allsearchs = Product::where('manu_id', $manus->manu_id)->get();
        } else if (request()->option == "alls") {
            $search = Product::whereNotNull('manu_id')->paginate(6);
            $allsearchs = Product::whereNotNull('manu_id')->get();
        } 
        return view('search', [
            'user' => $user,
            'allmanus' => $allmanus,
            'allproducts' => $allproducts,
            'search' => $search,
            'topsellings' => $topsellings,
            'allsearchs' => $allsearchs,
        ]);
    }
    // Gio hang
    function carts($action = "", $product_id = "")
    {
        $user = Auth::user();
        if ($action == "add") {
            if (session()->has('carts' . $product_id)) {
                if (request()->quantity != null) {
                    for ($i = 0; $i < (int)request()->quantity; $i++) {
                        session()->increment('carts' . $product_id);
                    }
                } else {
                    session()->increment('carts' . $product_id);
                }
            } else {
                session()->put('carts' . $product_id, 1);
            }
        }
        if ($action == "+") {
            session()->increment('carts' . $product_id);
        }
        if ($action == "-") {
            if (session()->decrement('carts' . $product_id) == 0) {
                session()->pull('carts' . $product_id);
            }
        }
        if ($action == "delete") {
            session()->pull('carts' . $product_id);
        }
        $allmanus = Manufacturer::all();
        $allproducts = Product::all();
        return view('carts', [
            'user' => $user,
            'allmanus' => $allmanus,
            'allproducts' => $allproducts,
        ]);
    }
    // San pham
    function products($product_id, $manu_id)
    {
        $user = Auth::user();
        $allmanus = Manufacturer::all();
        $allproducts = Product::all();
        $product = Product::where('product_id', $product_id)->first();
        $productManus = Product::where('manu_id', $manu_id)->get();
        return view('products', [
            'user' => $user,
            'allmanus' => $allmanus,
            'allproducts' => $allproducts,
            'allmanus' => $allmanus,
            'product' => $product,
            'productManus' => $productManus,
        ]);
    }
    // Trang chu
    function index($name = 'index')
    {
        $user = Auth::user();
        $allmanus = Manufacturer::all();
        $allproducts = Product::all();
        $newproducts = Product::orderBy('created_at', 'desc')->take(10)->get();
        $newproduct1 = Product::where('manu_id', 1)->orderBy('created_at', 'desc')->take(5)->get();
        $newproduct2 = Product::where('manu_id', 2)->orderBy('created_at', 'desc')->take(5)->get();
        $newproduct3 = Product::where('manu_id', 3)->orderBy('created_at', 'desc')->take(5)->get();
        $newproduct4 = Product::where('manu_id', 4)->orderBy('created_at', 'desc')->take(5)->get();
        $newproduct5 = Product::where('manu_id', 5)->orderBy('created_at', 'desc')->take(5)->get();
        $topsellings = Product::where('sale', '>', 0)->get();
        $topselling1 = Product::where('manu_id', 1)->where('sale', '>', 3)->get();
        $topselling2 = Product::where('manu_id', 2)->where('sale', '>', 3)->get();
        $topselling3 = Product::where('manu_id', 3)->where('sale', '>', 3)->get();
        $topselling4 = Product::where('manu_id', 4)->where('sale', '>', 3)->get();
        $topselling5 = Product::where('manu_id', 5)->where('sale', '>', 3)->get();
        return view($name, [
            'user' => $user,
            'allmanus' => $allmanus,
            'allproducts' => $allproducts,
            'newproducts' => $newproducts,
            'newproduct1' => $newproduct1,
            'newproduct2' => $newproduct2,
            'newproduct3' => $newproduct3,
            'newproduct4' => $newproduct4,
            'newproduct5' => $newproduct5,
            'topsellings' => $topsellings,
            'topselling1' => $topselling1,
            'topselling2' => $topselling2,
            'topselling3' => $topselling3,
            'topselling4' => $topselling4,
            'topselling5' => $topselling5,
        ]);
    }
}
