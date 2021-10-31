<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stock;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stock::create([
            'generic_name' => 'Amoxicillin',
            'brand_name' => 'Amoxil',
            'dosage' => 'Capsules',
            'strength' => '500mg',
        ]);
    }
}
