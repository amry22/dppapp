<?php

namespace Database\Seeders;

use App\Models\DataDepartment;
use App\Models\DataDivision;
use App\Models\ItemRoles;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role_id' => '1'
        ]);

        ItemRoles::insert([
            [
                'name' => 'Admin'
            ],
            [
                'name' => 'Kabid'
            ],
            [
                'name' => 'Kadep'
            ],
            [
                'name' => 'Staff'
            ]
        ]);

        DataDivision::insert([
            [
                'name' => 'Bidang Tarbiyah'
            ],
            [
                'name' => 'Bidang Dakwah dan Pelayanan Ummat'
            ],
            [
                'name' => 'Bidang Pembinaan dan Pengembangan Organisasi'
            ],
            [
                'name' => 'Bidang Perekonomian'
            ],
            [
                'name' => 'Kesekretariatan'
            ],
            [
                'name' => 'Kebendaharaan'
            ]
        ]);

        DataDepartment::insert([
            [
                'data_division_id' => '1',
                'name' => 'Departemen Perkaderan'
            ],
            [
                'data_division_id' => '1',
                'name' => 'Departemen Pendidikan Dasar dan Menengah'
            ],
            [
                'data_division_id' => '1',
                'name' => 'Departemen Pendidikan Tinggi dan Litbang'
            ],
            [
                'data_division_id' => '1',
                'name' => 'Departemen Kepesantrenan'
            ],
            [
                'data_division_id' => '1',
                'name' => 'Departemen Pembinaan Keluarga dan PAUD'
            ],
            [
                'data_division_id' => '2',
                'name' => 'Departemen Komunikasi dan Penyiaran'
            ],
            [
                'data_division_id' => '2',
                'name' => 'Departemen Rekrutmen dan Pembinaan Anggota'
            ],
            [
                'data_division_id' => '2',
                'name' => 'Departemen Kesehatan'
            ],
            [
                'data_division_id' => '2',
                'name' => 'Departemen Sosial'
            ],
            [
                'data_division_id' => '3',
                'name' => 'Departemen Organisasi'
            ],
            [
                'data_division_id' => '3',
                'name' => 'Departemen Sumberdaya Insani'
            ],
            [
                'data_division_id' => '3',
                'name' => 'Departemen Hubungan Antarbangsa'
            ],
            [
                'data_division_id' => '3',
                'name' => 'Departemen Hubungan Antar Lembaga'
            ],
            [
                'data_division_id' => '3',
                'name' => 'Departemen Hukum'
            ],
            [
                'data_division_id' => '4',
                'name' => 'Departemen Ekonomi Kelembagaan/BUMO'
            ],
            [
                'data_division_id' => '4',
                'name' => 'Departemen Keuangan'
            ],
            [
                'data_division_id' => '4',
                'name' => 'Departemen Ekonomi Keumatan'
            ],
            [
                'data_division_id' => '5',
                'name' => 'Wakil Sekretaris Jenderal I'
            ],
            [
                'data_division_id' => '5',
                'name' => 'Wakil Sekretaris Jenderal II'
            ],
            [
                'data_division_id' => '5',
                'name' => 'Kepala Biro Humas'
            ],
            [
                'data_division_id' => '5',
                'name' => 'Badan Pengamanan Hidayatullah'
            ],
            [
                'data_division_id' => '6',
                'name' => 'Wakil Bendahara Umum'
            ],
            [
                'data_division_id' => '6',
                'name' => 'Badan Pengumpul Keuangan Organisasi'
            ],
        ]);
    }
}
