<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up() : void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->json('weekday');
            $table->string('time');
            $table->unsignedBigInteger('person_id');

            $table->foreign('person_id')
                ->references('id')
                ->on('people')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down() : void
    {
        Schema::dropIfExists('appointments');
    }
};
