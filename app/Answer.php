<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    protected $guarded = [];


    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    public function exam_user()
    {
        return $this->belongsTo('App\ExaminationUser');
    }

    public function option()
    {
        return $this->belongsTo('App\Option');
    }

}
