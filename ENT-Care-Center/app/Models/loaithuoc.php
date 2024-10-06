<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loaithuoc extends Model
{
    use HasFactory;
    protected $table = 'loaithuoc';
    protected $primaryKey = 'id_loai';
    public $timestamps = false;


    // Khai báo các trường có thể gán
    protected $fillable = ['ten_loai'];
}
