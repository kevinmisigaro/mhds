<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsuranceCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('insurance_cards')->insert([
            'insurance_number' => '1234XYZ',
            'owner_id' => 1,
            'company_id' => 1,
            'type' => 'Health',
        ]);
    }
}
