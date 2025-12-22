<?php

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
        Schema::create('inventory_stock_in', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('asset_inventory_id')->constrained('asset_inventory');
            $table->decimal('quantity', 15, 2);
            $table->string('usage_for')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->foreignId('created_by')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_stock_in');
    }
};
