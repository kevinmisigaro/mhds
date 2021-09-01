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
            'manager_id' => 3
        ]);
        DB::table('insurance_companies')->insert([
            'company_name' => 'Alliance',
            'manager_id' => 3
        ]);
        DB::table('insurance_companies')->insert([
            'company_name' => 'NHIF',
            'manager_id' => 3
        ]);
    }
}
