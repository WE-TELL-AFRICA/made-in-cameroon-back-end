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
        Schema::create('artisans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('labour');
            $table->string('city');
            $table->string('email');
            $table->longText('description');
            $table->string('phone_number');
            $table->double('rating');
            $table->timestamps();
            $table->unsignedBigInteger('profile_image_id')->nullable();
            $table->foreign('profile_image_id')->references('id')->on('images');

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artisans');
    }
};
