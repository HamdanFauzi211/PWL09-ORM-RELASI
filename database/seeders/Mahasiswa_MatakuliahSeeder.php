<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Mahasiswa_MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mhs_matkul = [
            [
                'mahasiswa_id' => '1941720141',
                'matakuliah_id' => '1',
                'nilai' => 'B+'
            ],
            [
                'mahasiswa_id' => '1941720145',
                'matakuliah_id' => '1',
                'nilai' => 'A'
            ],
            [
                'mahasiswa_id' => '1941720199',
                'matakuliah_id' => '1',
                'nilai' => 'C'
            ],
            [
                'mahasiswa_id' => '1941720200',
                'matakuliah_id' => '1',
                'nilai' => 'B'    
            ]
            
        ];

        DB::table('mahasiswa_matakuliah')->insert($mhs_matkul);
    }
}