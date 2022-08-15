<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_app')->nullalbe();
            $table->string('alamat')->nullalbe();
            $table->string('notelp')->nullalbe();
            $table->string('kurs')->nullalbe();
            $table->string('kecamatan')->nullalbe();
            $table->string('atm')->nullalbe();
            $table->string('logo')->nullalbe();
            $table->string('exportfile')->nullalbe();


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
        Schema::dropIfExists('settings');
    }
}
