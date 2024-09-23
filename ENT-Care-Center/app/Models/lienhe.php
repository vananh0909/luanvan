<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lienhe extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'lienhe';
    public $timestamps = false;
    protected $fillable = ['id', 'ten', 'email', 'phone', 'mess'];
}
