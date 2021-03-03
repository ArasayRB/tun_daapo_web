<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_service', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->date('status_date')->nullable();
            $table->date('unstatus_date')->nullable();
            $table->unsignedBigInteger('paket_id');
            $table->unsignedBigInteger('service_id');
            $table->timestamps();
            $table->foreign('paket_id')->references('id')->on('pakets')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paket_service');
    }
}
