<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionImage extends Model
{
    use SoftDeletes;
    protected $table = "question_images";

    public $timestamps = false;
    protected $guarded = array();

	public function option()
	{
		return $this->hasOne('App\Question', 'id', 'question_id');
	}

}
