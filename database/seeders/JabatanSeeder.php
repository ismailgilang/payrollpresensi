<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatan = [
            [
                "kode_jabatan"   => "adm2024",
                "jabatan"   => "admin",
                "gajiPokok" => 3000000
            ],
            [
                "kode_jabatan"   => "spv2024",
                "jabatan"   => "supervisor",
                "gajiPokok" => 3500000
            ],
        ];
        foreach ($jabatan as $item) {
            Jabatan::create([
                "jabatan"   => $item['jabatan'],
                "gajiPokok"   => $item['gajiPokok'],
            ]);
        }
    }
}
