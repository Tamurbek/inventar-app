<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getAll(Request $request)
    {
        $product = Product::where('categories_id', $request->categories_id)->get();
        $categories = Category::all();
        $categories_name = Category::find($request->categories_id);
        return view('products', [
            'product' => $product,
            'categories'=>$categories,
            'categories_name'=>$categories_name,
        ]);
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
            $product->categories_id = $request->categories_id;
            $product->save();
    
            return redirect()->route('product.getAll',$request->categories_id);
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
                $path = 'uploads/product/';
                $file->move(public_path($path), $filename);
                $product->image = $path . $filename;
            }
    
            $product->name = $request->name;
            $product->price= $request->price;
            $product->people_id = $request->people_id;
            $product->save();
    
            return response()->json($product);
        }catch (Exception $e){
            return redirect()->route('product.getAll',$request->categories_id);
        }
    }

    public function update(Request $request, $id){
        // try{
            $product= Product::find($id);
            $catedories_id = $product->categories_id;
            // dd($catedories_id);
            // dd($product->categories_id);
            if(!$product){
                response()->json(['message'=> 'Product not found'] ,404);
            }

            if ($request->has('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                // dd($filename);
                $path = 'uploads/product/';
                $file->move($path, $filename);
        
                if ($product->image && file_exists($product->image)) {
                    unlink($product->image);
                }
        
                $product->image = $path . $filename;
            }
            $product->name = $request->name;
            $product->price = $request->price;
            $product->categories_id = $request->categories_id;
            $product->save();
            return redirect()->route('product.getAll', $catedories_id);
        // }catch(Exception $e){
        //     return redirect()->route('product.getAll');
        // }
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
