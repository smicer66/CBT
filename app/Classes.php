<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends Model
{

    use SoftDeletes;

    protected $table = "classes";

    protected $fillable =
        [
            'name'
        ];

    protected $hidden =
        [
            '_token',
        ];

    function class_arm() {
        return $this->hasMany('App\ClassArms', 'class_id', 'id');
    }

}
