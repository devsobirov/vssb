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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('status')->default(1);
            $table->string('code')->unique();

            $table->string('fullname');
            $table->string('phone');
            $table->string('email');
            $table->string('passport')->nullable();
            $table->string('address');
            $table->string('applicant_type');
            $table->string('subject');
            $table->string('file')->nullable();
            $table->longText('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
