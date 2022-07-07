<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->json('name');
            $table->string('slug')->unique();
            $table->string('description')->nullable();
            $table->string('location')->nullable(); // Menu location
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
