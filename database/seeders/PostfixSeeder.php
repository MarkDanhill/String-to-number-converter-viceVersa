<?php

namespace Database\Seeders;

use App\Models\Postfix;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostfixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array = [
            'teen' => 10,
            'ty' => 10,
            'hundred' => 100,
            'thousand' => 1000,
            'thousands' => 1000,
            'million' => 1000000,
            'billion' => 1000000000
        ];

        foreach ($array as $key => $value) {
            DB::transaction(function () use ($key, $value) {
                Postfix::create([
                    'name' => $key,
                    'value' => $value,
                ]);
            });
        }
    }
}
