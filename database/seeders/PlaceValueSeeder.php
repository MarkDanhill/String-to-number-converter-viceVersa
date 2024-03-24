<?php

namespace Database\Seeders;

use App\Models\PlaceValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaceValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            'thousand' => 2,
            'million' => 3,
            'billion' => 4
        ];

        foreach ($array as $key => $value) {
            DB::transaction(function () use ($key, $value) {
                PlaceValue::create([
                    'name' => $key,
                    'value' => $value,
                ]);
            });
        }
    }
}
