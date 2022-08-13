<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->string('nama_c');
            $table->string('email_c');
            $table->string('hp_c');
            $table->string('alamat_c');
            $table->string('debit_c');
            $table->string('kredit_c');
            $table->string('asal_c');
            $table->string('no_atm_c');
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
        Schema::dropIfExists('customers');
    }
}
