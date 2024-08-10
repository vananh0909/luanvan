<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class admin  extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;
    protected $primaryKey = 'id_admin';
    protected $table = 'admin';
    protected $fillable = ['id_admin', 'AD_Name', 'AD_Phone', 'AD_Email', 'AD_Password'];

    // public function roles()
    // {
    //     return $this->belongsToMany('App\Models\Roles');
    // }
    public function roles()
    {
        return $this->belongsToMany('App\Models\roles');
    }
    public function getAuthIdentifierName()
    {
        return 'AD_Email';
    }
    public function getAuthPassword()
    {
        return $this->AD_Password;
    }



    // public function hasAnyRoles($roles)
    // {
    //     if (!is_array($roles)) {
    //         $roles = [$roles];
    //     }
    //     return null !== $this->roles()->whereIn('name', $roles)->first();
    // }
    // public function hasRole($role)
    // {
    //     if (!is_array($role)) {
    //         $role = [$role];
    //     }

    //     return null !== $this->roles()->where('name', $role)->first();

    // if (!is_array($role)) {
    //     $role = [$role];
    // }
    // return $this->roles()->whereIn('name', $role)->exists();
    // }
}