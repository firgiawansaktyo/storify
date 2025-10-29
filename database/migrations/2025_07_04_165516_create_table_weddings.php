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
        Schema::create('weddings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('wedding_image')->nullable();
            $table->string('wedding_title');
            $table->string('wedding_sub_title');
            $table->text('wedding_description');
            $table->text('wedding_prayer_verse')->nullable();
            $table->string('wedding_video')->nullable();
            $table->string('wedding_audio')->nullable();
            $table->text('wedding_message_template');
            $table->string('wedding_landing_image')->nullable();
            $table->string('wedding_landing_title');
            $table->string('wedding_hotnews_image')->nullable();
            $table->text('wedding_hotnews_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weddings');
    }
};
