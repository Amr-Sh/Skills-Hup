<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Cat;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    public function index(){
        $data['skills']= Skill::orderBy('id','DESC')->paginate(10);
        $data['cats']= Cat::select('id','name')->get();
        return view('admin.skills.index')->with($data);
    }
    public function store(Request $request){

        $request->validate([
            'name_en'=>'required|string|max:50',
            'name_ar'=>'required|string|max:50',
            'img'=>'required|image|max:2048',
            'cat_id'=>'required|exists:cats,id',
        ]);

        Skill::create([
            'name'=>json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
           // 'img' => $request->img,
            'cat_id' => $request->cat_id,
        ]);
        session()->flash('msg','Skill added successfully');
        return back();
     }

    public function update(Request $request){




        $request->validate([
            'id'=>'required|exists:skills,id',
            'name_en'=>'required|string|max:50',
            'name_ar'=>'required|string|max:50',
            'img'=>'nullable|image|max:2048',
            'cat_id'=>'required|exists:cats,id',
        ]);

        $skill = Skill::findOrFail($request->id);
        $path= $skill->img;

        // if($request->hasFile('img')){
        //     $skill->deleteImage($path);
        // }
        $skill->update([
            'name'=>json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'img'=>$path,
            'cat_id'=>$request->cat_id,
        ]);
        session()->flash('msg','category updated successfully');
        return back();
    }

    public function toggle(Skill $skill){
        $skill->update([
            'active'=> ! $skill->active,
        ]);
        return back();
    }

     public function delete(Skill $skill){
        try {
            $skill->delete();
            $skill->deleteImage($skill->img);
            $msg = 'Skill deleted successfully';
            session()->flash('msg', $msg);
        } catch (Exception $e) {
            $error = 'can not delete this Skill';
            session()->flash('error', $error);
        }

        //session()->flash('msg', $msg);
        return back();
    }
}
