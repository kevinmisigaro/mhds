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
        ]);
        DB::table('insurance_companies')->insert([
            'company_name' => 'Alliance',
        ]);
        DB::table('insurance_companies')->insert([
            'company_name' => 'NHIF',
        ]);
    }
}
