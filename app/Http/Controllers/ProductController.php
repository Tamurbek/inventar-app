<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAll()
    {
        $product = Product::all();
        return view('products', ['product' => $product]);
    }    

    public function All()
    {
        $product = Product::all();
        return response()->json($product);
    }    

    public function get($id){
        $product=Product::find($id);
        if(!$product){
            response()->json(['message'=>'Peop not found'] ,404);
        }
        return response()->json($product);
    }

    public function create(Request $request){
        // try{
            $product = new Product();
            if ($request->has('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = 'uploads/product/';
                $file->move(public_path($path), $filename);
                $product->image = $path . $filename;
            }
    
            $product->name = $request->name;
            $product->price = $request->price;
            $product->price_visible = ($request->price_visible=== 'on') ? true : false;
            $product->category_id = $request->category_id;
            $product->save();
    
            return redirect()->route('product.getAll');
        // }catch (Exception $e){
        //     return redirect()->route('product.getAll');
        // }
    }

    public function addProduct(Request $request){
        try{
            $product = new Product();
            if ($request->has('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = 'uploads/Product/';
                $file->move(public_path($path), $filename);
                $product->image = $path . $filename;
            }
    
            $product->name = $request->name;
            $product->price= $request->price;
            $product->people_id = $request->people_id;
            $product->save();
    
            return response()->json($product);
        }catch (Exception $e){
            return redirect()->route('product.getAll');
        }
    }

    public function update(Request $request, $id){
        try{
            $product= Product::find($id);
            if(!$product){
                response()->json(['message'=> 'Product not found'] ,404);
            }

            if ($request->has('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                // dd($filename);
                $path = 'uploads/Product/';
                $file->move($path, $filename);
        
                if ($product->image && file_exists($product->image)) {
                    unlink($product->image);
                }
        
                $product->image = $path . $filename;
            }

            $product->update([
                'name'=> $request->name,
                'price'=> $request->price,
                'people_id'=> $request->people_id,
            ]);
            return redirect()->route('product.getAll');
        }catch(Exception $e){
            return redirect()->route('product.getAll');
        }
    }

    public function delete($id){
        $product=Product::find($id);
        if(!$product){
            response()->json(['message'=> 'Product not found'] ,404);
        }
        $product->delete();
        return redirect()->route('product.getAll');
    }
}
