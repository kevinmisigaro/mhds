<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfitMarginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profit_margins')->insert([
            'company_id' => 1,
            'margin' => 1.5
        ]);
        DB::table('profit_margins')->insert([
            'company_id' => 2,
            'margin' => 2
        ]);
        DB::table('profit_margins')->insert([
            'company_id' => 3,
            'margin' => 2.5
        ]);
    }
}
