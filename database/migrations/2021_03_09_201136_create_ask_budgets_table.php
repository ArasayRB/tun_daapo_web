<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAskBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ask_budgets', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('name_or_company');
            $table->string('contact_phone');
            $table->unsignedBigInteger('paket_id')->nullable();
            $table->timestamps();
            $table->foreign('paket_id')->references('id')->on('pakets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ask_budgets');
    }
}
