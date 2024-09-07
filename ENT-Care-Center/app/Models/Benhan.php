<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benhan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_benhan';
    protected $table = 'benhan';
    public $timestamps = false;
    protected $fillable = ['id_benhan', 'id_lh', 'huyetap', 'nhiptim', 'nhietdo', 'chuandoan', 'ghichu'];
}
