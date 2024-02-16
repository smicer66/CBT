<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $guarded = [];


    public $timestamps = false;
	//

	public function examination()
	{
		return $this->belongsTo('\App\Examination');
	}
}
