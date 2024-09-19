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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('suit_id');
            $table->unsignedBigInteger('size_id');
            $table->string('name');
            $table->string('phone');
            $table->boolean('include_pants')->default(false);
            $table->boolean('include_vest')->default(false);
            $table->boolean('include_tie')->default(false);
            $table->boolean('include_bow_tie')->default(false);
            $table->boolean('include_pocket_square')->default(false);
            $table->date('reservation_date');
            $table->date('return_date');
            $table->integer('height')->nullable();
            $table->integer('waist')->nullable();
            $table->integer('thighs')->nullable();
            $table->integer('calves')->nullable();
            $table->integer('slim')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['incomplete', 'completed', 'to_collect'])->default('incomplete');
            $table->integer('price');
            $table->foreign('suit_id')->references('id')->on('suits')->onDelete('cascade');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
            $table->boolean('include_shirt')->default(false); // لإضافة القميص
            $table->string('shirt_size')->nullable(); // مقاس القميص
            $table->string('shirt_color')->nullable(); // لون القميص
            $table->boolean('include_brooch')->default(false); // لإضافة بروش
            $table->string('pants_size')->nullable(); // مقاس البنطال
            $table->string('pants_color')->nullable(); // لون البنطال
            $table->string('pants_type')->nullable(); // نوع البنطال
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
