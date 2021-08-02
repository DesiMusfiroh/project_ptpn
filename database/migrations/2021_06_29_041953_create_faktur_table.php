<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakturTable extends Migration
{
    public function up()
    {
        Schema::create('faktur', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur');
            $table->string('tanggal_faktur');
            $table->integer('sales_id');
            $table->integer('wilayah_id');
            $table->string('nama_outlet');
            $table->decimal('penjualan');
            $table->decimal('cash_in')->nullable();
            $table->decimal('piutang');
            $table->string('keyword')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('faktur');
    }
}
