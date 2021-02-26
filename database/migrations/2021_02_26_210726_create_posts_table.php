<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('default_lang');
            $table->longText('content');
            $table->text('summary');
            $table->boolean('publicate_state');
            $table->string('img_url')->default('postDefault.jpg');
            $table->string('video_url')->nullable();
            $table->string('qr_img_url')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->integer('cant_access_read')->nullable();
            $table->integer('cant_likes')->nullable();
            $table->integer('cant_shares')->nullable();
            $table->text('tags');
            $table->text('slug')->unique();
            $table->text('keywords')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categoria_posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
