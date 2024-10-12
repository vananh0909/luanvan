<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thongke extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'thongke';
    public $timestamps = false;
    protected $fillable = ['ngay', 'donthuoc', 'doanhthu'];
}
