<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->json('name');
            $table->string('path');
            $table->string('category')->nullable();
            $table->string('size')->nullable();
            $table->integer('downloaded')->nullable()->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
