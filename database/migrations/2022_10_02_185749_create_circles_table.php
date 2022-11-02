<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('circles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('object_id')->references('id')->on('page_objects')->onDelete('cascade');
            $table->integer('radius')->default(50);
            $table->string('fill')->default('');
            $table->string('stroke')->default('#000000');
            $table->integer('stroke_width')->default(2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('circles');
    }
};
