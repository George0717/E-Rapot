<?php

namespace Database\Seeders;

use App\Models\SmClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SmClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
        'A',
        'B',
        'C',
        'D',
        'E',
        'F'
    ];

    foreach ($classes as $class) {
        SmClass::create(['name' => $class]);
    }
    }
}
