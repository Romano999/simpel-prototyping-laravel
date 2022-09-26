<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('text_boxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('object_id')->references('id')->on('page_objects')->onDelete('cascade');
            $table->string("text")->default("Hello world!")->nullable(true);
            $table->string("font")->default("10px sans-serif");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('text_boxes');
    }
};
