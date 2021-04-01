<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Exception;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function index(){
        $data['cats']= Cat::orderBy('id','DESC')->paginate(10);
        return view('admin.cats.index')->with($data);
    }
    public function store(Request $request){

       $request->validate([
           'name_en'=>'required|string|max:50',
           'name_ar'=>'required|string|max:50',
       ]);

       Cat::create([
           'name'=>json_encode([
               'en' => $request->name_en,
               'ar' => $request->name_ar,
           ]),
       ]);
       session()->flash('msg','category added successfully');
       return back();
    }

    public function update(Request $request){

        $request->validate([
            'id'=>'required|exists:cats,id',
            'name_en'=>'required|string|max:50',
            'name_ar'=>'required|string|max:50',
        ]);

        Cat::findOrFail($request->id)->update([
            'name'=>json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
        ]);
        session()->flash('msg','category updated successfully');
        return back();
    }
    public function toggle(Cat $cat){
        $cat->update([
            'active'=> ! $cat->active,
        ]);
        return back();
    }
    public function delete(Cat $cat){
        try {
            $cat->delete();
            $msg = 'category deleted successfully';
            session()->flash('msg', $msg);
        } catch (Exception $e) {
            $error = 'can not delete this category';
            session()->flash('error', $error);
        }

        //session()->flash('msg', $msg);
        return back();
    }
}
