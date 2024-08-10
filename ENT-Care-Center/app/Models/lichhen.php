<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class lichhen extends Model
{
    use HasFactory;
    protected $primaryKey = 'LH_Id';
    protected $table = 'lichhen';

    protected $fillable = ['LH_Id', 'LH_CustomerID', 'LH_BSkham', 'LH_Ngaykham', 'LH_Giokham', 'LH_Email', 'LH_trieuchung'];



    public function addlichhen($data)
    {
        // dd($data);
        DB::insert('INSERT INTO lichhen (LH_CustomerID, LH_BSkham, LH_Ngaykham, LH_Giokham, LH_Email, LH_trieuchung) values( ?, ?, ?, ?, ?, ?)', $data);
    }


    public static function getLichHen()
    {
        $userId = session('user')['CUS_Id'];

        $lichhen = DB::select('
        SELECT lichhen.*, customer.*
        FROM lichhen
        LEFT JOIN customer ON lichhen.LH_CustomerID = customer.CUS_Id
        WHERE lichhen.LH_CustomerID = ?
        ORDER BY lichhen.LH_Ngaykham DESC
        LIMIT 1', [$userId]);

        return $lichhen;
    }
}
