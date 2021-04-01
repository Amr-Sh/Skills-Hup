<?php

namespace App\Http\Controllers\Api;

use App\Models\Cat;
use Illuminate\Http\Request;
use App\Http\Resources\CatResource;
use App\Http\Controllers\Controller;

class CatController extends Controller
{
    public function index(){

    //  $cats=Cat::select('id','name')->with('skills')->get();
    //  return $cats;
        return CatResource::collection(Cat::get());
    }
    public function show($id){

        $cat = Cat::with('skills')->findOrFail($id);
            return new CatResource($cat);
        }
}
