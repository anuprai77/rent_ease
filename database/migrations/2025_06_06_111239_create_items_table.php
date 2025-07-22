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
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');

            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('min_rental_duration');
            $table->decimal('weekly_rent', 8, 2);
            $table->enum('condition', ['new', 'like_new', 'good', 'fair', 'poor'])->default('good'); // condition of the item
            $table->decimal('min_deposit',8,2);
            $table->enum('delivery_option',['self_pickup','delivery','courier']);

            $table->boolean('is_available')->default(true); // true = available for rent

            $table->string('image_path')->nullable();
            $table->boolean('is_featured')->default(false);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
