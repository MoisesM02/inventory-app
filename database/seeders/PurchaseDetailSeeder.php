<?php

namespace Database\Seeders;

use App\Models\PurchaseDetail;
use App\Models\SaleDetail;
use Database\Factories\PurchaseDetailFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PurchaseDetail::factory(10)->create();
        SaleDetail::factory(10)->create();
    }
}
