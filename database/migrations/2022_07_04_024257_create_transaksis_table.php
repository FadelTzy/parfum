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
            $table->string('id_user')->nullable();
            $table->string('tanggalpesan')->nullable();
            $table->string('tanggalbayar')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('jenistransaksi')->nullable();
            $table->string('tanggalfaktur')->nullable();
            $table->string('nopemesanan')->nullable();
            $table->string('tipe')->comment('1 piutang 2 utang')->nullable();
            $table->string('status')->comment('1 lunas 2 belum')->nullable();
            $table->string('diskon')->nullable();
            $table->string('jenistransfer')->comment('tunai / transfer')->nullable();
            $table->string('mediatransfer')->comment('transfer')->nullable();
            $table->string('totalharga')->nullable();
            $table->string('hargadiskon')->nullable(); 
            $table->string('hargasetelahdiskon')->nullable();
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
