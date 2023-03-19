<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //*****get all products in the db */
        $products = Products::select('id','productName','productColor','productCategory','productPrice')->orderBy('id','desc')->get();

        return view('home',compact('products'));
    }
}
