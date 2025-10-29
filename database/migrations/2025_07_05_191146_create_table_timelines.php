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
        Schema::create('timelines', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->string('wedding_vow_date');
            $table->string('wedding_vow_start_time');
            $table->string('wedding_vow_end_time');
            $table->text('wedding_vow_location');
            $table->text('wedding_vow_address');
            $table->text('wedding_vow_iframe');
            $table->string('wedding_reception_date');
            $table->string('wedding_reception_start_time');
            $table->string('wedding_reception_end_time');
            $table->text('wedding_reception_location');
            $table->text('wedding_reception_address');
            $table->text('wedding_reception_iframe');
            $table->string('wedding_vow_image');
            $table->string('wedding_reception_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timelines');
    }
};
