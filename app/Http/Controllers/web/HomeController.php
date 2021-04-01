<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Exam;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        $data['exams']=Exam::select('skill_id','id','name','img')->limit(8)->get();
        return view('web.home.index')->with($data);
    }
}
