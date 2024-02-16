<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{

    public $timestamps = false;
	protected $guarded = [];

    public function getCorrectAnswerAttribute($isCorrect)
    {
        return (bool)$isCorrect;
    }

    public function question()
    {
        return $this->belongsTo('App\Question');
	}
	
	public function optionImages()
    {
		return $this->hasMany('\App\OptionImage', 'option_id', 'id');
	}
}
