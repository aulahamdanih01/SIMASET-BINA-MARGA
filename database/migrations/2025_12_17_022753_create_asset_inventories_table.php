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
        Schema::create('asset_inventories', function (Blueprint $table) {
            $table->id();
            
            $table->string('code')->unique();
            $table->string('photo')->nullable(); // ✅ FOTO ASSET
            $table->string('name');
            $table->foreignId('asset_category_id')->constrained('asset_categories');
            $table->text('specification')->nullable();
            $table->integer('stock')->default(0);
            $table->foreignId('asset_inventory_unit_id')->constrained('asset_inventory_units');
            $table->timestamp('created_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamp('updated_at')->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_inventories');
    }
};
