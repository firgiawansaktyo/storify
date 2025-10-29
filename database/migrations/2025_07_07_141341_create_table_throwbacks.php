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
        Schema::create('throwbacks', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->string('wedding_throwback_image');
            $table->string('wedding_throwback_title');
            $table->text('wedding_throwback_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('throwbacks');
    }
};
