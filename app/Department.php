<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    public $timestamps = false;
    protected $guarded = array();

	public function courses()
	{
		return $this->hasMany('\App\Course','department_offering');
	}

    public function faculty()
    {
        return $this->belongsTo('\App\Faculty');
    }

    public static function boot(){
        parent::boot();
        static::deleted(function($department){
            $department->courses()->delete();
        });
    }
}
