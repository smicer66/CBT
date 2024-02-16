<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed status
 * @property string status_inactive
 * @property string status_active
 * @property mixed str_verify
 */
class Examination extends \Eloquent
{
    use SoftDeletes;

    protected $status_inactive = 'inactive';
    protected $status_active = 'active';
    protected $status_archived = 'archived';
    protected $status_created = 'created';
    protected $guarded = ['score_weight_type', 'show_result'];
    protected $dates = ['exam_date'];

    public function course()
    {
        return $this->belongsTo('\App\Course');
    }

    /** Accessor to tell if Examination is set or not
     * @return bool
     */
    public function getIsActiveAttribute()
    {
        if ($this->status == $this->status_active) {
            return true;
        }

        return false;
    }



    public function getIsCreatedAttribute()
    {
        if ($this->status == $this->status_created) {
            return true;
        }

        return false;
    }


    public function getExamDateAttribute($attribute)
    {
//        dd($this->exam_date);
        if($attribute == null)
            return date('d M Y h:i A',\Carbon\Carbon::now()->timestamp);
        else{
            $dtime = \DateTime::createFromFormat("Y-m-d H:i:s",$attribute);
            $timestamp = $dtime->getTimestamp();
            return date('d M Y h:i A',$timestamp);
        }

    }

//    public function setExamDateAttribute($attribute)
//    {
////        dd($attribute);
//        $dtime = \Carbon\Carbon::createFromFormat("d m Y h:i A", $attribute);
//        dd($dtime);
//        $timestamp = $dtime->getTimestamp();
//        $this->attributes['exam_date'] = $timestamp;
//    }

    public function getReadableDurationAttribute() {
        $duration = Carbon::createFromTime(null, $this->duration);
        return $duration;
    }


    /** Get all questions associated with Examination
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	function class_() {
        return $this->hasOne('App\Classes', 'id', 'class_id');
    }
	
	function class_arm() {
        return $this->hasOne('App\ClassArms', 'id', 'class_arm_id');
    }
	
	
    public function questions()
    {
        return $this->hasMany('\App\Question');
    }

    public function settings()
    {
        return $this->hasMany('\App\Setting');
    }

    public function getHasBeenWrittenAttribute()
    {
        $examUsers = $this->examinationUsers()->where('result', '!=', 'null')->get();
        if (count($examUsers) > 0) {
            return true;
        }

        return false;
    }

    /**
     * @return Eloquent\Relations\HasMany
     */
    public function examinationUsers()
    {
        return $this->hasMany('\App\ExaminationUser');
    }

    /**
     * Accessor to check if the examination is archived or not
     * @return bool
     */
    public function getIsArchivedAttribute()
    {

        if ($this->getOriginal('status') == $this->status_archived) {
           return true;
        }

        return false;
    }

    public function getStatusAttribute($status)
    {
        return $this->attributes['status'];
    }


    public function getReadableStatusAttribute() {
        $status = $this->status;
        switch($status) {
            case $this->status_inactive:
                return 'Not set for writing';
                break;
            case $this->status_active:
                return 'Being taken';
                break;
            case $this->status_archived:
                return 'The examination has ended.';
                break;
            default:
                return 'Unknown';
        }
    }

    public function getExamDateObjectAttribute()
    {
        return Carbon::parse($this->exam_date);
    }


    public static function boot(){
        parent::boot();
        static::deleted(function($examination){
//            if($examination->questions()) {
//                $examination->questions()->delete();
//            }
            if($examination->settings()) {
                $examination->settings()->delete();
            }
            if($examination->examinationUsers()) {
                $examination->examinationUsers()->delete();
            }
        });
    }
}
