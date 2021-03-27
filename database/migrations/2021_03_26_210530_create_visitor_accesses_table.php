<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_accesses', function (Blueprint $table) {
            $table->id();
            $table->string('ip_visitor')->unique();
            $table->date('date_access');
            $table->boolean('accept_privacy_pol')->nullable();
            $table->date('date_privacy_pol')->nullable();
            $table->boolean('accept_terms_cond')->nullable();
            $table->date('date_terms_cond')->nullable();
            $table->boolean('accept_cookies')->nullable();
            $table->date('date_cookies')->nullable();
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
        Schema::dropIfExists('visitor_accesses');
    }
}
