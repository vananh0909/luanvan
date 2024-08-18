<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function roles()
    {
        return $this->belongsToMany('App\Models\roles', 'user_roles', 'User_id', 'roles_id_roles');
    }

    public function hasAnyRoles($roles)
    {
        return null !== $this->roles()->WhereIn('name', $roles)->first();
    }

    public function hasRole($role)
    {
        return null !== $this->roles()->Where('name', $role)->first();
    }

    public function lichTruc()
    {
        return $this->hasMany(lt_lichtrucbs::class, 'user_id');
    }
}
