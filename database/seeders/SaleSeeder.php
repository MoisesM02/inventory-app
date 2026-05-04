<?php

namespace Database\Seeders;

use App\Models\SaleDetail;
use Database\Factories\SaleDetailsFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SaleDetail::factory(15)->create();
    }
}
