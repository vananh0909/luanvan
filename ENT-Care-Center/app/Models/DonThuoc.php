<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonThuoc extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_donthuoc';
    protected $table = 'donthuoc';
    public $timestamps = false;
    protected $fillable = ['id_donthuoc', 'id_benhan', 'tenthuoc', 'lieuluong', 'cachsd', 'id_thuoc'];
}
