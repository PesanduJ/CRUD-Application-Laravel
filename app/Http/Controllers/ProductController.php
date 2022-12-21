<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        //get the latest data from database
        $products = Product::latest()->paginate(5);

        //return retrieved data along with the index view + page numbers
        return view('products.index',compact('products'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return create view
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the input
        $request->validate([
            'name' => 'required',
            'details' => 'required'
        ]);

        //create a new product
        Product::create($request->all());

        //redurect the user and send a friendly message
        return redirect()->route('products.index')->with('success','Product Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //return show view along with the particular product id
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //return edit view along with the particular product id
        return view('products.edit',compact('product'));
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
        //validate the input
        $request->validate([
            'name' => 'required',
            'details' => 'required'
        ]);

        //update product using the product we have already, we dont create a new one
        $product->update($request->all());

        //redurect the user and send a friendly message
        return redirect()->route('products.index')->with('success','Product Details Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //delete the product
        $product->delete();

        //redirect the user and send a friendly message
        return redirect()->route('products.index')->with('success','Product Deleted Successfully');
    }
}
