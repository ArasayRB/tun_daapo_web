<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostVisitorAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_visitor_accesses', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->boolean('like')->nullable();
            $table->date('like_date')->nullable();
            $table->boolean('read')->nullable();
            $table->date('read_date')->nullable();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('visitor_id');
            $table->timestamps();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('visitor_id')->references('id')->on('visitor_accesses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_visitor_accesses');
    }
}
