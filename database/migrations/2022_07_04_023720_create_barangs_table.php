<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullalbe();
            $table->string('merek')->nullalbe();
            $table->string('nama')->nullalbe();
            $table->string('satuan')->nullalbe();
            $table->string('jumlah')->nullalbe();
            $table->string('harga')->nullalbe();
            $table->string('gambar')->nullalbe();
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
        Schema::dropIfExists('barangs');
    }
}
