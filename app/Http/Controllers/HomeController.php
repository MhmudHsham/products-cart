<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = Product::all();
        return view('home', compact('products'));
    }

    public function add_to_cart($product_id) {
        $new_array = array();
        if (Session::has("products")) {
            $data_stored = Session::get("products");
            if (in_array($product_id, $data_stored)) {
                foreach ($data_stored as $one) {
                    if ($one == $product_id) {
                        continue;
                    }
                    array_push($new_array, $one);
                }
                Session::put('products', $new_array);
            } else {
                array_push($data_stored, $product_id);
                Session::put('products', $data_stored);
            }
        } else {
            array_push($new_array, $product_id);
            Session::put('products', $new_array);
        }
        $data_stored = Session::get("products");
        print_r($data_stored);
    }

}
