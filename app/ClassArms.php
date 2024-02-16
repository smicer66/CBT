<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ClassArms extends Model
{

    use SoftDeletes;

    protected $table = "class_arms";

    protected $fillable =
        [
            'arm_name',
            'class_id',
        ];

    protected $hidden =
        [
            '_token',
        ];

    function class_() {
        return $this->hasOne('App\Classes', 'id', 'class_id');
    }

    
	/*function form_teacher(){
        return $this->hasOne(User::class, 'id', 'form_teacher_user_id');
    }

    function students()
    {
        return $this->hasMany(Students::class, 'current_class__arm_id', 'id');
    }*/
}
