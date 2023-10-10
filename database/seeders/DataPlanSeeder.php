<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_plans')->insert([
            [
                'name' => '10 GB',
                'price' => '100000',
                'operator_cards_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => '25 GB',
                'price' => '120000',
                'operator_cards_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => '40GB',
                'price' => '150000',
                'operator_cards_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => '60 GB',
                'price' => '180000',
                'operator_cards_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => '10 GB',
                'price' => '100000',
                'operator_cards_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => '25 GB',
                'price' => '120000',
                'operator_cards_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => '40GB',
                'price' => '150000',
                'operator_cards_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => '60 GB',
                'price' => '180000',
                'operator_cards_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => '10 GB',
                'price' => '100000',
                'operator_cards_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => '25 GB',
                'price' => '120000',
                'operator_cards_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => '40GB',
                'price' => '150000',
                'operator_cards_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'name' => '60 GB',
                'price' => '180000',
                'operator_cards_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),

            ]

        ]);
    }
}
