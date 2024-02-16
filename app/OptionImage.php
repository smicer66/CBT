<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OptionImage extends Model
{
    use SoftDeletes;
    protected $table = "option_images";

    public $timestamps = false;
    protected $guarded = array();

	public function option()
	{
		return $this->hasOne('App\Option', 'id', 'option_id');
	}

}
