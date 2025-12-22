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
        Schema::create('asset_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('fixed_asset_id')->constrained('fixed_assets');
            $table->enum('event_type', ['mutation', 'condition_change', 'maintenance']);
            $table->foreignId('old_user')->nullable()->constrained('users');
            $table->foreignId('new_user')->nullable()->constrained('users');
            $table->foreignId('old_status')->nullable()->constrained('asset_conditions');
            $table->foreignId('new_status')->nullable()->constrained('asset_conditions');
            $table->string('reference')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamp('created_at')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_histories');
    }
};
