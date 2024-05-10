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
        Schema::create('astrologer', function (Blueprint $table) {
            $table->id();
            $table->string('astrologer_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('gender');
            $table->string('service');
            $table->string('profile_pic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('astrologer');
    }
};
