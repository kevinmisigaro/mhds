<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InsuranceCard;

class InsuranceCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InsuranceCard::create([
            'insurance_number' => '1234XYZ',
            'owner_id' => 1,
            'company_id' => 1,
            'type' => 'Health',
            'issue_date' => '2019-06-01',
            'expiry_date' => '2021-06-01'
        ]);
    }
}
