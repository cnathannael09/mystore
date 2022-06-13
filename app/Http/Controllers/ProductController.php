<?php

namespace App\Http\Controllers;

use App\Product;
use App\Medicine;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function front_index()
    {
        //Query Raw
        // $queryRaw = DB::select(DB::raw("select * from products"));
        // dd($queryRaw);

        //Query Builder
        // $queryBuilder = DB::table('products')->get();

        //Eloquent
        // $queryModel = Product::all();

        //Pada controller dan view
        // return view('product.index',compact('queryBuilder'));

        //Pada controller dan pada View diubah namanya menjadi data
        // return view('product.index',['data'=>$queryBuilder]);

        $medicines = Medicine::all();
        return view('frontend.product', compact('medicines'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function addToCart($id)
    {
        $m=Medicine::find($id);
        $cart=session()->get('cart');
        if(!isset($cart[$id])){
            $cart[$id]=[
                "name"=>$m->generic_name,
                "quantity"=>1,
                "price"=>$m->price,
                "photo"=>$m->image
            ];
        }else{
            $cart[$id]['quantity']++;
        }
        session()->put('cart',$cart);
        return redirect()->back()->with('success', 'Medicine Added to cart successfully!');
    }

    public function cart(){
        return view('frontend.cart');
    }
}
