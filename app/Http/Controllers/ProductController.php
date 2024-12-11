<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){

        return view('products.index',['products'=>Product::latest()->paginate(5)]);
    }

    public function create(){
        return view('products.create');
    }
    public function store(Request $request){

        // Validate the input
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image file
    ]);

        // Store the uploaded image
    $imageName = time() . '.' . $request->images->extension();
    $request->images->move(public_path('products'), $imageName);

    // Save other data to the database (example)
    $product = new Product();
    $product->name = $request->name;
    $product->description = $request->description;
    $product->image = $imageName; // Save the image path or name
    $product->save();

    // Return a response (example)
    return redirect()->back()->with('success', 'Product created successfully.');

    
    }
    public function edit($id){
         $product = Product::where('id',$id)->first();
        return view('products.edit',['product' => $product]);
    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image file
        ]);

        $product = Product::where('id',$id)->first();

        if(isset($request->image)){
            // Store the uploaded image
        $imageName = time() . '.' . $request->images->extension();
        $request->images->move(public_path('products'), $imageName);
        $product->image = $imageName; // Save the image path or name
        }
    
        // Save other data to the database (example)
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();
    
        // Return a response (example)
        return redirect()->back()->with('success', 'Product updated successfully.');
    }
    public function destroy($id){
        $product = Product::where('id',$id)->first();
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
    public function show($id){
        $product = Product::where('id',$id)->first();

        return view('products.show',['product'=>$product]);
    }

}
