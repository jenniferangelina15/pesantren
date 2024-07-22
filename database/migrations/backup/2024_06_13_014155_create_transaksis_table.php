<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_transaksi');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->integer('kostum_id')->unsigned();
            $table->foreign('kostum_id')->references('id')->on('kostum')->onDelete('cascade');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->enum('status', ['sewa', 'kembali']);
            $table->integer('total_harga')->nullable();
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
        Schema::dropIfExists('transaksi');
    }
}
