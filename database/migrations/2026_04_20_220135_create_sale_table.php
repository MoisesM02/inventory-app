<?php

use App\Models\Costumer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->string('description');
            $table->double('total_price');
            $table->foreignIdFor(Costumer::class)->constrained()->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::create('sale_details', function (Blueprint $table) {
           $table->id();
           $table->double('price');
           $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate();
           $table->foreignIdFor(Sale::class)->constrained()->cascadeOnDelete();
           $table->integer('quantity');
           $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
        Schema::dropIfExists('sale_details');
    }
};
