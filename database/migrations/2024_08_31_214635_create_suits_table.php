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
        Schema::create('suits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('price')->default(0);
            $table->string('color')->nullable();
            $table->enum('type', ['men', 'children', 'mixed', 'grooms_suit'])->default('men');
            $table->enum('product_type', ['shirts', 'pants', 'suits'])->default('suits');
            $table->string('status')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suits');
    }
};
