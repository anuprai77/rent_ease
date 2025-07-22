<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('order_items', function (Blueprint $table) {
        $table->decimal('discount_rate', 5, 2)->default(0); // e.g. 10 for 10%
        $table->decimal('discount_amount', 10, 2)->default(0);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
        $table->dropColumn(['discount_rate', 'discount_amount']);
        });
    }
};
