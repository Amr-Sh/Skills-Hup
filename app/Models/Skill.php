<?php

namespace App\Models;

use QCod\ImageUp\HasImageUploads;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Skill extends Model
{
    use HasFactory;
    use HasImageUploads;


         protected static $imageFields = [
            'img'=> [
                'width' => 825,
                'height' => 550,
                'crop' => true,
               'rules' => 'image|max:2048',
                'file_input' => 'img',
                'path' => 'skills',
            ],
    ];
    protected function imgUploadFilePath($file) {
        return $this->id .'-'. $file->getClientOriginalName();
    }

    protected $guarded=['id','created_at','updated_at'];

    public function cat()
    {
        return $this->belongsTo(Cat::class);
    }
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
    public function name($lang=null){
        $lang= $lang ?? App::getLocale();
        return json_decode($this->name)->$lang;
    }
    public function studentCount(){
        $studentNum=0;
        foreach($this->exams as $exam){
          $studentNum +=  $exam->users()->count();
        }
        return $studentNum;
    }
    public function scopeActive($query){

        return $query->where('active', 1);
    }

}

