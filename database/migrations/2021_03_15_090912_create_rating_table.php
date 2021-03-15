<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating', function (Blueprint $table) {
            $table->id();
            $table->string('clientip', 100)->nullable();
            $table->unsignedBigInteger('productid')->index();
            $table->foreign('productid')->references('id')->on('product')->onDelete('cascade');
            $table->tinyInteger('rate')->unsigned()->default(0);
            $table->string('comment', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rating');
    }
}
