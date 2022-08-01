<?php

namespace Database\Seeders;

use App\Models\FinancialRole;
use Illuminate\Database\Seeder;

class FinancialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FinancialRole::factory()->count(10)->create();

    }
}
