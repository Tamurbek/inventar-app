<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function getAll()
    {
        $userId = Auth::id();
        $category = Category::where("users_id", $userId)->get();
        return view('categories', ['categories' => $category]);
    }    

    public function All()
    {
        $category = Category::all();
        return response()->json($category);
    }    

    public function get($id){
        $category=Category::find($id);
        if(!$category){
            response()->json(['message'=>'Peop not found'] ,404);
        }
        return response()->json($category);
    }

    public function create(Request $request){
        try{
            $category = new Category();
            if ($request->has('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = 'uploads/category/';
                $file->move(public_path($path), $filename);
                $category->image = $path . $filename;
            }
    
            $userId=Auth::user()->id;

            $category->name = $request->name;
            $category->users_id= $userId;
            $category->save();
    
            return redirect()->route('category.getAll');
        }catch (Exception $e){
            return redirect()->route('category.getAll');
        }
    }

    public function addCategory(Request $request){
        try{
            $category = new Category();
            if ($request->has('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = 'uploads/category/';
                $file->move(public_path($path), $filename);
                $category->image = $path . $filename;
            }
    
            $category->name = $request->name;
            $category->save();
    
            return response()->json($category);
        }catch (Exception $e){
            return redirect()->route('category.getAll');
        }
    }

    public function update(Request $request, $id){
        try{
            $Category= Category::find($id);
            if(!$Category){
                response()->json(['message'=> 'Category not found'] ,404);
            }

            if ($request->has('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                // dd($filename);
                $path = 'uploads/Category/';
                $file->move($path, $filename);
        
                if ($Category->image && file_exists($Category->image)) {
                    unlink($Category->image);
                }
        
                $Category->image = $path . $filename;
            }

            $Category->name = $request->name;
            $Category->save();
            
            return redirect()->route('category.getAll');
        }catch(Exception $e){
            return redirect()->route('category.getAll');
        }
    }

    public function delete($id){
        $Category=Category::find($id);
        if(!$Category){
            response()->json(['message'=> 'Category not found'] ,404);
        }
        $Category->delete();
        return redirect()->route('category.getAll');
    }
}
