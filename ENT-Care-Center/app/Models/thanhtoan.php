<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class thanhtoan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'thanhtoan';
    public $timestamps = false;
    protected $fillable = ['id', 'id_benhan', 'id_donthuoc', 'tongtien', 'ngaythanhtoan', 'trangthai'];
}
