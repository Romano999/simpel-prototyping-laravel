<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('page_objects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->integer("pos_x")->default(100);
            $table->integer("pos_y")->default(100);
            $table->integer("z_index")->default(0);
            $table->integer('angle')->default(0);
            $table->integer('height')->default(100);
            $table->integer('width')->default(100);
            $table->enum('object_type', ['text_box', 'image', 'rectangle', 'circle', 'triangle']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_objects');
    }
};
