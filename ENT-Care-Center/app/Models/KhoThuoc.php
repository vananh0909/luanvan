<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhoThuoc extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_thuoc';
    protected $table = 'khothuoc';
    public $timestamps = false;
    protected $fillable = ['id_thuoc', 'tenthuoc', 'soluong', 'donvi', 'giathuoc', 'cachdung', 'lieuluong', 'mota', 'id_loai', 'nguongtoithieu', 'ngaysanxuat', 'hansudung'];
}
