<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignId("week_id");
            $table->foreignId("top_five_rank")->nullable();
            $table->foreignId("top_ten_rank");
            $table->string('name');
            $table->string('artist');
            $table->string('album');
            $table->string('album_id');
            $table->string('preview_url');
            $table->string('spotify_id');
            $table->string('album_cover');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_tracks');
    }
};
