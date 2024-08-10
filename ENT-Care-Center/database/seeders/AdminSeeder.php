<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\admin;
use App\Models\roles;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        admin::truncate(); //xóa tất cả giá trị trong bảng, đặt id lại giá trị đầu
        DB::table('admin_roles')->truncate();
        $adminRoles = roles::where('name', 'admin')->first();
        $doctorRoles = roles::where('name', 'doctor')->first();
        $nhanvienRoles = roles::where('name', 'nhanvienquanli')->first();

        $admin = Admin::create([
            'AD_Name' => 'admin',
            'AD_Phone' => '0911245779',
            'AD_Email' => 'admin@gmail.com',
            'AD_Password' => Hash::make('09102002')
        ]);
        $doctor = Admin::create([
            'AD_Name' => 'doctor',
            'AD_Phone' => '0911245777',
            'AD_Email' => 'doctor@gmail.com',
            'AD_Password' => Hash::make('09102002')
        ]);
        $nv = Admin::create([
            'AD_Name' => 'nv',
            'AD_Phone' => '0911245778',
            'AD_Email' => 'nv@gmail.com',
            'AD_Password' => Hash::make('09102002')
        ]);


        // attach sẽ tự hiểu bảng admin_roles là sử dụng 2 class admin và roles. để mỗi vai trò admin sẽ có liên quan đến roles khi tạo
        $admin->roles()->attach($adminRoles);
        $doctor->roles()->attach($doctorRoles);
        $nv->roles()->attach($nhanvienRoles);
        \Database\Factories\UserFactory::new()->count(17)->create();
    }
}
