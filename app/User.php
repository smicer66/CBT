<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * Class User
 * @property mixed session_id
 * @package App
 */
class User extends \Eloquent implements AuthenticatableContract, CanResetPasswordContract
{

    use SoftDeletes;
	use Authenticatable, CanResetPassword, EntrustUserTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'identity_no', 'password','role_id', 'class_id', 'class_arm_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


    /**
     * Get a collection of user roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role()
    {
        return $this->belongsTo('\App\Role');
    }

    /**
     * Returns true if the user has an Examiner role
     *
     * @return bool
     */
    public function isExaminer()
    {
        return $this->hasRole('student');
    }

    /**
     * Returns true if user is an Administrator
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->hasRole('administrator');
    }

    /**
     * Returns true if the user is not a student
     *
     * @return bool
     */
    public function isStaff()
    {
        return !$this->isStudent() ?: false;
    }

    /** Returns true if the user has a student role
     * @return bool
     */
    public function isStudent()
    {
        return $this->hasRole('student');
    }


    public function examinationUsers()
    {
        return $this->hasMany('\App\ExaminationUser');
    }

    public function getUserDepartmentAttribute($dept_id) {
        return Department::find($this->department);
    }

    public function getLevelAttribute()
    {
        $level = Level::find($this->getOriginal('level'));
        if($level) {
            return $level->name;
        }
        return "N/A";
    }

    public static function boot(){
        parent::boot();
        static::deleted(function($user){
            $user->examinationUsers()->delete();
        });
    }
	
	function class_() {
        return $this->hasOne('App\Classes', 'id', 'class_id');
    }
	
	
	function classArm() {
        return $this->hasOne('App\ClassArms', 'id', 'class_arm_id');
    }

//    public function department() {
//        return $this->hasMany('\App\Department', 'department');
//    }


}

