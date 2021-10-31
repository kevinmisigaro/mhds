<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfitMargin;

class ProfitMarginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProfitMargin::create([
            'company_id' => 1,
            'margin' => 1.5
        ]);

        ProfitMargin::create([
            'company_id' => 2,
            'margin' => 2
        ]);

    }
}
