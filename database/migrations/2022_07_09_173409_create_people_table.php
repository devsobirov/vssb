<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('image')->nullable();
            $table->json('position')->nullable();
            $table->json('info')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->integer('priority')->nullable()->default(1);
            $table->boolean('has_appoints')->nullable()->default(true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('people');
    }
};
