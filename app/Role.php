<?php namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

    protected $table = 'role_user';
    protected $guarded = array();

//    public function users()
//    {
//        return $this->belongsToMany('\App\User');
//    }

}
