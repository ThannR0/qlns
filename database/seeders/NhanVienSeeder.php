<?php

namespace Database\Seeders;

use App\Models\NhanVien;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class NhanVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'nhanvien_id' => NhanVien::factory()->create([
                'phucap_id' => DB::table('phucap')->inRandomOrder()->first()->id,
                'bangcap_id' => DB::table('bangcap')->inRandomOrder()->first()->id,
                'chuyenmon_id' => DB::table('chuyenmon')->inRandomOrder()->first()->id,
                'ngoaingu_id' => DB::table('ngoaingu')->inRandomOrder()->first()->id,
                'dantoc_id' => DB::table('dantoc')->inRandomOrder()->first()->id,
                'tongiao_id' => DB::table('tongiao')->inRandomOrder()->first()->id,
                'hovaten' => 'Nguyễn Đức Thân',
                'sdt' => '0849295535',
                'gioitinh' => false
            ]),
            'email' => 'admin@email.com',
            'role' => 2
        ]);

        User::factory()->create([
            'nhanvien_id' => NhanVien::factory()->create([
                'phucap_id' => DB::table('phucap')->inRandomOrder()->first()->id,
                'bangcap_id' => DB::table('bangcap')->inRandomOrder()->first()->id,
                'chuyenmon_id' => DB::table('chuyenmon')->inRandomOrder()->first()->id,
                'ngoaingu_id' => DB::table('ngoaingu')->inRandomOrder()->first()->id,
                'dantoc_id' => DB::table('dantoc')->inRandomOrder()->first()->id,
                'tongiao_id' => DB::table('tongiao')->inRandomOrder()->first()->id,
                'hovaten' => 'Nguyen Quan Ly',
                'sdt' => '0934343444',
                'gioitinh' => false
            ]),
            'email' => 'quanly@email.com',
            'role' => 1
        ]);

        User::factory()->create([
            'nhanvien_id' => NhanVien::factory()->create([
                'phucap_id' => DB::table('phucap')->inRandomOrder()->first()->id,
                'bangcap_id' => DB::table('bangcap')->inRandomOrder()->first()->id,
                'chuyenmon_id' => DB::table('chuyenmon')->inRandomOrder()->first()->id,
                'ngoaingu_id' => DB::table('ngoaingu')->inRandomOrder()->first()->id,
                'dantoc_id' => DB::table('dantoc')->inRandomOrder()->first()->id,
                'tongiao_id' => DB::table('tongiao')->inRandomOrder()->first()->id,
                'hovaten' => 'Nguyen Nhan Vien',
                'sdt' => '09343430156',
                'gioitinh' => false
            ]),
            'email' => 'nhanvien@email.com', 
            'role' => 0
        ]);

        for($i=1; $i<=20; $i++)
        {
            User::factory()->create([
                'nhanvien_id' => NhanVien::factory()->create([
                    'phucap_id' => DB::table('phucap')->inRandomOrder()->first()->id,
                    'bangcap_id' => DB::table('bangcap')->inRandomOrder()->first()->id,
                    'chuyenmon_id' => DB::table('chuyenmon')->inRandomOrder()->first()->id,
                    'ngoaingu_id' => DB::table('ngoaingu')->inRandomOrder()->first()->id,
                    'dantoc_id' => DB::table('dantoc')->inRandomOrder()->first()->id,
                    'tongiao_id' => DB::table('tongiao')->inRandomOrder()->first()->id
                ]),
                'role' => 0
            ]);
        }
    }
}
