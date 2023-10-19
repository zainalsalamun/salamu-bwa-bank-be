<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tips')->insert([
            [
                'title' => 'Cara menyimpan uang di Bank',
                'thumbnail' => 'nabung.jpg',
                'url' => 'https://www.ruangmenyala.com/article/read/prosedur-menabung-di-bank',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cara berinvestasi dengan baik',
                'thumbnail' => 'saham.jpg',
                'url' => 'https://www.manulife.co.id/id/artikel/mengenal-jenis-investasi-dan-cara-berinvestasi-untuk-pemula.html',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cara berinvestasi emas',
                'thumbnail' => 'emas.jpg',
                'url' => 'https://www.ocbcnisp.com/id/article/2021/04/16/cara-investasi-emas',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
