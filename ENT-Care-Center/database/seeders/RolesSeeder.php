<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { // truncate khi phát hiện csdl sẽ xóa toàn bộ csdl trong bảng roles
        Roles::truncate();
        Roles::create(['name' => 'admin']);
        Roles::create(['name' => 'doctor']);
        Roles::create(['name' => 'nhanvienquanli']);
    }
}
