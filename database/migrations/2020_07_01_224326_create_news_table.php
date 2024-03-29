<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image')->default('imagen.jpg');
            $table->string('title');
            $table->string('slug')->unique();
            $table->mediumText('summary');
            $table->mediumText('content');
            $table->string('video')->nullable();
            $table->enum('featured', [1, 2, 3])->nullable();
            $table->enum('comment', [0, 1])->default(1);
            $table->enum('state', [1, 2])->default(1);
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
        Schema::dropIfExists('news');
    }
}
