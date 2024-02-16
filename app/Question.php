<?php namespace App;

use Illuminate\Database\Eloquent;

class Question extends \Eloquent
{

    public $timestamps = false;
    protected $guarded = [];

    public function examination()
    {
        return $this->belongsTo('\App\Examination');
    }

    public function options()
    {
		return $this->hasMany('\App\Option');
	}
	
	
	public function qnImages()
    {
		return $this->hasMany('\App\QuestionImage', 'question_id', 'id');
	}




    public static function boot(){
        parent::boot();
        static::deleted(function($question){
            $question->options()->delete();
        });
    }


}
