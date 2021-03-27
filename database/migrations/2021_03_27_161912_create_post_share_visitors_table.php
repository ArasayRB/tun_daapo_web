<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostShareVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_share_visitors', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('page')->nullable();
            $table->string('neth')->nullable();
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
        Schema::dropIfExists('post_share_visitors');
    }
}
