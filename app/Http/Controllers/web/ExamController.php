<?php

namespace App\Http\Controllers\web;
use App\Models\Exam;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ExamController extends Controller
{
   function show($id){
        $data['exam']=Exam::findOrFail($id);
        $data['showStartBtn']=true;
        $user=Auth::user();

        if( $user !== null ) {
            $pivotRow = $user->exams()->where('exam_id',$id)->first();

            if ( $pivotRow !== null and $pivotRow->pivot->status == 'closed' ) {
                $data['showStartBtn']=false;
            }
        }

       return view('web.exam.show')->with($data);
   }


   function start($examId){

        $user=Auth::user();
        if(! $user->exams->contains($examId) ){
            $user->exams()->attach($examId);
        }else{
            $user->exams()->updateExistingPivot($examId,[
                'status'=>"closed",
            ]);
        }

        session()->flash('prev',"start/$examId");
        return redirect(url("exam/questions/$examId"));
   }

   function showQuestions($examId){

       if( session('prev') !== "start/$examId" ){
           return redirect(url("exam/show/$examId"));
       }
       session()->flash('prev',"questions/$examId");

    $data['exam']=Exam::findOrFail($examId);
    $data['ques']=$data['exam']->questions()->get();
    return view('web.exam.questions')->with($data);
   }
   function submit(Request $request, $examId ) {

        if( session('prev') !== "questions/$examId" ){
          return redirect(url("exam/show/$examId"));
    }

    $exam=Exam::findOrFail($examId);
    //calculate score
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

    $user=Auth::user();
    $pivotRow=$user->exams()->where('exam_id',$examId)->first();
    $startTime=$pivotRow->pivot->created_at;
    $submitTime=Carbon::now();
    $timeMins=$startTime->diffInMinutes($submitTime);

    if($timeMins > $pivotRow->duration_mins){
        $score=0;
    }
    //update pivot table
    $user->exams()->updateExistingPivot($examId,[
        'score'=>$score,
        'time_mins'=>$timeMins
    ]);
    $request->session()->flash('success',"you finished exam succesfully with score $score%");
    return redirect("/exam/show/$examId");
    }
}
