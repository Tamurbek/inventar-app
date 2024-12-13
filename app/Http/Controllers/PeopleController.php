<?php

namespace App\Http\Controllers;

use App\Models\People;
use Exception;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function getAll()
    {
        $people = People::all();
        return view('persons', ['people' => $people]);
    }    

    public function get($id){
        $people=People::find($id);
        if(!$people){
            response()->json(['message'=>'Peop not found'] ,404);
        }
        return response()->json($people);
    }

    public function create(Request $request){
        try{
            $person = new People();
            if ($request->has('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = 'uploads/people/';
                $file->move(public_path($path), $filename);
                $person->image = $path . $filename;
            }
    
            $person->name = $request->name;
            $person->username = $request->username;
            $person->password = bcrypt($request->password);
            $person->save();
    
            return redirect()->route('people.getAll');
        }catch (Exception $e){
            return redirect()->route('people.getAll');
        }
    }

    public function update(Request $request, $id){
        try{
            $person= People::find($id);
            if(!$person){
                response()->json(['message'=> 'People not found'] ,404);
            }

            if ($request->has('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = 'uploads/people/';
                $file->move($path, $filename);
        
                if ($person->image && file_exists($person->image)) {
                    unlink($person->image);
                }
        
                $person->image = $path . $filename;
            }

            $person->update([
                'name'=> $request->name,
                'username'=> $request->username,
                'password'=> $request->password,
            ]);
            return redirect()->route('people.getAll');
        }catch(Exception $e){
            return redirect()->route('people.getAll');
        }
    }

    public function delete($id){
        $person=People::find($id);
        if(!$person){
            response()->json(['message'=> 'Person not found'] ,404);
        }
        $person->delete();
        return redirect()->route('people.getAll');
    }

}