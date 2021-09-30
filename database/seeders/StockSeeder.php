<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stocks')->insert([
            'generic_name' => 'Amoxicillin',
            'brand_name' => 'Amoxil',
            'quantity' => 10,
            'purchase_price' => 5000.0,
            'dosage' => 'Capsules',
            'strength' => '500mg',
            'expiry_date' => '2021-12-01'
        ]);
    }
}
