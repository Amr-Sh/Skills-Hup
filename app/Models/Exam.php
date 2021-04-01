<?php

namespace App\Models;

use QCod\ImageUp\HasImageUploads;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Exam extends Model
{
    use HasFactory;
    use HasImageUploads;

    protected static $imageFields = [
        'img'=> [
            'width' => 825,
            'height' => 550,
            'crop' => true,
           //'rules' => 'image|max:2048',
            'file_input' => 'img',
            'path' => 'exams',
        ],
    ];
    protected function imgUploadFilePath($file) {
        return $this->id .'-'. $file->getClientOriginalName();
    }
    protected $guarded=['id','created_at','updated_at'];

    public function users(){
       return  $this->belongsToMany(User::class)
       ->withPivot(['score', 'time_mins','status'])
       ->withTimestamps();
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function name($lang=null){
        $lang= $lang ?? App::getLocale();
        return json_decode($this->name)->$lang;
    }
    public function desc($lang=null){
        $lang= $lang ?? App::getLocale();
        return json_decode($this->desc)->$lang;
    }
    public function scopeActive($query){

        return $query->where('active', 1);;
    }



}
