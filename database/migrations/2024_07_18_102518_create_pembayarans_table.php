<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_pembayaran');
            $table->integer('santri_id')->unsigned();
            $table->foreign('santri_id')->references('id')->on('santri')->onDelete('cascade');
            $table->string('bukti')->nullable();
            $table->enum('status', ['belum setuju', 'setuju']);
            $table->string('bulan');
            $table->integer('kelas');
            $table->string('nominal');
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
        Schema::dropIfExists('pembayaran');
    }
}
