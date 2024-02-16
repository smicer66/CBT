<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationUser extends Model
{
    protected $table = 'examination_users';

    protected $dates = ['started_at'];

    protected $guarded = [];

    public function examination()
	{
		return $this->belongsTo('\App\Examination');
	}

    public function user() {
        return $this->belongsTo('\App\User');
    }

    public function getHasScoreAttribute() {
        if(! is_null($this->result)){
            return true;
        }
        return false;
    }
}
