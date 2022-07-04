<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostumersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costumers', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullalbe();;
            $table->string('email')->nullalbe();;
            $table->string('no')->nullalbe();;
            $table->string('alamat')->nullalbe();;
            $table->string('debit')->nullalbe();;
            $table->string('kredit')->nullalbe();;
            $table->string('asal')->nullalbe();;
            $table->string('no_atm')->nullalbe();;
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
        Schema::dropIfExists('costumers');
    }
}
