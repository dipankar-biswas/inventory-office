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
        Schema::create('stock_add_totals', function (Blueprint $table) {
            $table->id();
            $table->integer("stockin_id")->nullable();
            $table->integer("qty")->nullable();
            $table->integer("refund_status")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_add_totals');
    }
};
