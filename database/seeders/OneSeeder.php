<?php

namespace Database\Seeders;

use App\Models\One;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            'one' => 1,
            'two' => 2,
            'three' => 3,
            'four' => 4,
            'five' => 5,
            'six' => 6,
            'seven' => 7,
            'eight' => 8,
            'nine' => 9,
            'ten' => 10,
            'eleven' => 11,
            'twelve' => 12,
            'thirteen' => 13,
            'fifteen' => 15,
            'twen' => 2,
            'thir' => 3,
            'fif' => 5,
        ];

        foreach ($array as $key => $value) {
            DB::transaction(function () use ($key, $value) {
                One::create([
                    'name' => $key,
                    'value' => $value,
                ]);
            });
        }
    }
}
