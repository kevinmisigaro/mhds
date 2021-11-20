<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsuranceCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('insurance_companies')->insert([
            'company_name' => 'Jubilee',
            'manager_id' => 2,
            'active' => true,
            'margin' => 1.5
        ]);
        DB::table('insurance_companies')->insert([
            'company_name' => 'Alliance',
            'manager_id' => 3,
            'active' => true,
            'margin' => 2
        ]);
    }
}
