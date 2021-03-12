<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translates', function (Blueprint $table) {
            $table->id();
            $table->integer('id_content_trans');//original text id, for example(Post in this case)
            $table->longText('content');//original content
            $table->unsignedBigInteger('tipo_content');//Type of content, in this case is Post
            $table->string('indice_content');//in the original text(Table) the title of div input
            $table->timestamps();
            $table->foreign('tipo_content')->references('id')->on('content_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translates');
    }
}
