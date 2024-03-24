<?php

namespace Database\Seeders;

use App\Models\Ten;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $array = [
            'twenty' => 2,
            'thirty' => 3,
            'fourty' => 4,
            'fifty' => 5,
            'sixty' => 6,
            'seventy' => 7,
            'eighty' => 8,
            'ninety' => 9,
        ];

        foreach ($array as $key => $value) {
            DB::transaction(function () use ($key, $value) {
                Ten::create([
                    'name' => $key,
                    'value' => $value,
                ]);
            });
        }
    }
}
