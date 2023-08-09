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
        Schema::create('film', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('origin_name');
            $table->string('content');
            $table->string('type');
            $table->string('status');
            $table->string('thumb_url');
            $table->string('trailer_url');
            $table->string('time');
            $table->string('episode_total');
            $table->string('quality');
            $table->string('lang');
            $table->string('notify');
            $table->string('showtimes');
            $table->string('slug');
            $table->string('year');
            $table->integer('view');
            $table->string('actor');
            $table->string('director');
            $table->integer('category');
            $table->integer('country');
            $table->string('is_copyright');
            $table->string('poster_url');
            $table->integer('episodes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film');
    }
};
