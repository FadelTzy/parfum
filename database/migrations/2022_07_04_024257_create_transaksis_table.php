<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('id_t')->nullalbe();
            $table->string('id_c')->nullalbe();
            $table->string('id_k')->nullalbe();
            $table->string('id_b')->nullalbe();
            $table->string('diskon')->nullalbe();
            $table->string('jenis_transfer')->comment('tunai / transfer')->nullable();
            $table->string('total_t')->nullalbe();
            $table->string('jml_t')->nullalbe();
            
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
        Schema::dropIfExists('transaksis');
    }
}
