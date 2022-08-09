<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baskets', function (Blueprint $table) {
            $table->id();
            $table->string('id_barang')->nullable();
            $table->string('namabarang')->nullable();
            $table->string('kodebarang')->nullable();
            $table->string('gambar')->nullable();
            $table->string('tipe')->nullable();
            $table->string('harga')->nullable();
            $table->string('hargaS')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('diskon')->nullable();
            $table->string('satuan')->nullable();

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
        Schema::dropIfExists('baskets');
    }
}
