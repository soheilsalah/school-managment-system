<?php

namespace Database\Seeders;

use App\Models\Parents\StudentParent;
use Illuminate\Database\Seeder;

class StudentParentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        StudentParent::factory()->count(50)->create();
    }
}
