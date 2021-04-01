<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function show($id){

        $exam = Exam::findOrFail($id);
            return new ExamResource($exam);
    }
    public function showQuestions($id){

        $exam = Exam::with('questions')->findOrFail($id);
            return new ExamResource($exam);
    }


    function start(Request $request, $examId ) {

        $request->user()->exams()->attach($examId);
        return response()->json([
            'message'=>'you are started exam',
        ]);
    }
    function submit(Request $request, $examId ) {

       $validate= Validator::make($request->all(),[
            'answers'=>'required|array',
            'answers.*'=>'required|in:1,2,3,4'
        ]);

        if($validate->fails()){
            return response()->json($validate->errors());
        }

        //calculate score
        $exam=Exam::findOrFail($examId);

        $points=0;
        $totalQuesNum =$exam->questions->count();

        foreach ($exam->questions as $ques) {
            if (isset($request->answers[$ques->id])) {
                $userAns=$request->answers[$ques->id];
                $rightAns=$ques->right_ans;

                if ($userAns == $rightAns) {
                    $points+=1;
                }
            }
        }
        $score= ( $points / $totalQuesNum ) * 100;

        //clculate time mins

        $user= $request->user();
        $pivotRow= $user->exams()->where('exam_id',$examId)->first();
        $startTime= $pivotRow->pivot->created_at;
        $submitTime= Carbon::now();

        $timeMins= $startTime->diffInMinutes($submitTime);
        if($timeMins > $pivotRow->duration_mins){
             $score=0;
        }
        //update pivot table
        $user->exams()->updateExistingPivot($examId,[
            'score'=>$score,
            'time_mins'=>$timeMins
        ]);

         return response()->json([
             'message'=>"you submitted exam successfully with score $score",
         ]);
     }
}
