<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{

    use SoftDeletes;
    public $timestamps = false;
    protected $guarded = array();

    public function departments(){
    return $this->hasMany('\App\Department','faculty_id');
}

    public static function boot(){
        parent::boot();
        static::deleted(function($faculty){
            $faculty->departments()->delete();
        });
    }

}
