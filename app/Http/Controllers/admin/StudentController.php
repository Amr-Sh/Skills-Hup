<?php

namespace App\Http\Controllers\admin;

use App\Models\Exam;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index(){
        $studentRole=Role::where('name','student')->first();
        $data['students']=User::where('role_id',$studentRole->id)
        ->orderBy('id','DESC')
        ->paginate(10);
        return view('admin.students.index')->with($data);
    }
    public function showScore(User $user){
        if($user->role->name !== 'student'){
            return back();
        }
        $data['student']=$user;
        $data['exams']=$user->exams;

        return view('admin.students.show-score')->with($data);
    }
    public function openExam(User $user , Exam $exam){
        $pivotRow=$user->exams()->where('exam_id',$exam->id)->first();
        $status=$pivotRow->pivot->status;
        if($status == 'closed'){
            $status = 'opened';
        }else{
            $status = 'closed';
        }
        $user->exams()->updateExistingPivot($exam->id,[
            'status'=> $status,
        ]);


        return back();
    }


}
