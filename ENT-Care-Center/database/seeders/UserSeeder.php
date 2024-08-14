<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\roles;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate(); //xóa tất cả giá trị trong bảng, đặt id lại giá trị đầu
        DB::table('user_roles')->truncate();
        $adminRoles = roles::where('name', 'admin')->first();
        $doctorRoles = roles::where('name', 'doctor')->first();
        $nhanvienRoles = roles::where('name', 'nhanvienquanli')->first();

        $admin = User::create([
            'name' => 'Giám Đốc',
            'phone' => '0911245779',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('09102002')
        ]);
        $doctor = User::create([
            'name' => 'Bác Sĩ',
            'phone' => '0911245777',
            'email' => 'doctor@gmail.com',
            'password' => Hash::make('09102002')
        ]);
        $nv = User::create([
            'name' => 'nhân viên',
            'phone' => '0911245778',
            'email' => 'nv@gmail.com',
            'password' => Hash::make('09102002')
        ]);


        // attach sẽ tự hiểu bảng user_roles là sử dụng 2 class admin và roles. để mỗi vai trò admin sẽ có liên quan đến roles khi tạo
        $admin->roles()->attach($adminRoles);
        $doctor->roles()->attach($doctorRoles);
        $nv->roles()->attach($nhanvienRoles);
        \Database\Factories\UserFactory::new()->count(17)->create();
    }
}
