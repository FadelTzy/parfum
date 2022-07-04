<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->string('id_t')->nullalbe();
            $table->string('nama_pelanggan')->nullalbe();
            $table->string('tgl_nota')->nullalbe();
            $table->string('asal_kota')->nullalbe();
            $table->string('no_telp')->nullalbe();
            $table->string('jenis_transaksi')->nullalbe();
            $table->string('no_faktur')->nullalbe();
            $table->string('tgl_faktur')->nullalbe();
            $table->string('batas')->nullalbe();

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
        Schema::dropIfExists('notas');
    }
}
