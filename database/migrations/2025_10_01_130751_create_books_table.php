<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('publisher')->nullable();
            $table->string('isbn', 20)->nullable();
            $table->string('edition', 50)->nullable();
            $table->integer('year')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('shelf_location', 100)->nullable();
            $table->string('cover_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->date('validity_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
