<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Teen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $array = [
            'ten' => 10,
            'eleven' => 11,
            'twelve' => 12,
            'thirteen' => 13,
            'fourteen' => 14,
            'fifteen' => 15,
            'sixteen' => 16,
            'seventeen' => 17,
            'eighteen' => 18,
            'nineteen' => 19,
        ];

        foreach ($array as $key => $value) {
            DB::transaction(function () use ($key, $value) {
                Teen::create([
                    'name' => $key,
                    'value' => $value,
                ]);
            });
        }
    }
}
