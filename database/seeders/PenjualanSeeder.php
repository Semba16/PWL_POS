<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 3,
                'pembeli' => 'Dito',
                'penjualan_kode' => 'JL00001',
                'penjualan_tanggal' => '2024-02-29',
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 3,
                'pembeli' => 'Rival',
                'penjualan_kode' => 'JL00002',
                'penjualan_tanggal' => '2024-02-29',
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 3,
                'pembeli' => 'Sheilla',
                'penjualan_kode' => 'JL00003',
                'penjualan_tanggal' => '2024-02-29',
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 3,
                'pembeli' => 'Ronald',
                'penjualan_kode' => 'JL00004',
                'penjualan_tanggal' => '2024-02-29',
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 3,
                'pembeli' => 'Leo Messi',
                'penjualan_kode' => 'JL00005',
                'penjualan_tanggal' => '2024-02-29',
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 3,
                'pembeli' => 'David',
                'penjualan_kode' => 'JL00006',
                'penjualan_tanggal' => '2024-02-29',
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 3,
                'pembeli' => 'Semba',
                'penjualan_kode' => 'JL00007',
                'penjualan_tanggal' => '2024-02-29',
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 3,
                'pembeli' => 'Indra',
                'penjualan_kode' => 'JL00008',
                'penjualan_tanggal' => '2024-02-29',
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Zufar',
                'penjualan_kode' => 'JL00009',
                'penjualan_tanggal' => '2024-02-29',
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 3,
                'pembeli' => 'Tenma',
                'penjualan_kode' => 'JL00010',
                'penjualan_tanggal' => '2024-02-29',
            ],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}