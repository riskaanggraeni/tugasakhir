<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardProductController extends Controller
{
    public function index()
    {
        $products = Product::where('users_id', Auth()->user()->id)
        ->get();
        // dd($products);
        return view('pages.dashboard-products',[
            'products' => $products
        ]);
    }

    public function details($id)
    {
        // $products = Product::where('categories_id', Auth()->user()->id)
        // ->get();

        $products =  Product::findOrFail($id);

        // dd($products);
        return view('pages.dashboard-products-details', [
            'products' => $products
        ]);
    }

    // public function update(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'name' => 'required',
    //         'price' => 'required',
    //         'description' => 'required',
            
    //     ])
    // }

    public function create()
    {
        $categories = Category::all();
        return view('pages.dashboard-products-create',[
            'categories' => $categories
        ]);
    }
}
