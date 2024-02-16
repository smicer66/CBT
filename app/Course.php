<?php namespace App;

use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends \Eloquent
{

    use SoftDeletes;

    protected $guarded = [];

    public function examinations()
    {
        return $this->hasMany('\App\Examination');
    }

    public static function boot(){
        parent::boot();
        static::deleted(function($course){
            $course->examinations()->delete();
        });
    }
}
