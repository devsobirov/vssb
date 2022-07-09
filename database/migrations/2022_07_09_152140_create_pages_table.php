<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->json('title')->nullable();
            $table->json('body')->nullable();
            $table->string('slug')->nullable();
            $table->string('location')->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->integer('views')->nullable()->default(1);
            $table->boolean('published')->nullable()->default(false);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }
};
