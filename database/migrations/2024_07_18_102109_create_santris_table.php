<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSantrisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('nik');
            $table->string('kelas');
            $table->string('wali');
            $table->string('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->enum('jk', ['L', 'P']);
            $table->enum('status', ['tagih', 'lunas', 'cek']);
            $table->integer('bulan_tagihan');
            $table->string('password');
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
        Schema::dropIfExists('santri');
    }
}
