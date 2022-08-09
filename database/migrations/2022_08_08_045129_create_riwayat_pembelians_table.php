<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('id_barang')->nullable();
            $table->string('id_transak')->nullable();
            $table->string('id_user')->nullable();
            $table->string('namabarang')->nullable();
            $table->string('kodebarang')->nullable();
            $table->string('gambar')->nullable();
            $table->string('tipe')->nullable();
            $table->string('harga')->nullable();
            $table->string('hargas')->nullable();
            $table->string('satuan')->nullable();

            $table->string('jumlah')->nullable();
            $table->string('diskon')->nullable();
            $table->string('hargadiskon')->nullable();

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
        Schema::dropIfExists('riwayat_pembelians');
    }
}
