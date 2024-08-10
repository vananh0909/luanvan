<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
    protected $primaryKey = 'id_roles';
    protected $table = 'roles';

    public function admin()
    {
        return $this->belongsToMany('App\Models\admin');
    }
}
