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
        Schema::create('musics', function (Blueprint $table) {
            $table->uuid('id')->index();
            $table->foreignUuid('album_id')->index();
            $table->foreignUuid('user_id')->index();
            $table->string('name', 100);
            $table->string('hash');
            $table->string('original_name');
            $table->string('extension');
            $table->string('image_path');
            $table->string('path');
            $table->integer('duration')->unsigned()->nullable()->default(0);
            $table->integer('plays')->unsigned()->nullable()->default(0);
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
        Schema::dropIfExists('musics');
    }
};
