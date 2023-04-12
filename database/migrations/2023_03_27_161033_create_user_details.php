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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('user_id');
            $table -> integer('height') -> nullable();
            $table -> integer('chest_size') -> nullable();
            $table -> integer('waist_size') -> nullable();
            $table -> integer('hips_size') -> nullable();
            $table -> boolean('english') -> nullable();
            $table -> boolean('german') -> nullable();
            $table -> boolean('french') -> nullable();
            $table -> string('another_lang') -> nullable();
            $table -> boolean('catering_exp') -> nullable();
            $table -> boolean('modelling_exp') -> nullable();
            $table -> boolean('cashier_exp') -> nullable();
            $table -> boolean('entrance_exp') -> nullable();
            $table -> boolean('infodesk_exp') -> nullable();
            $table -> foreign('user_id') -> references('id') -> on('users') -> onDelete('cascade');
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
        Schema::dropIfExists('user_details');
    }
};
