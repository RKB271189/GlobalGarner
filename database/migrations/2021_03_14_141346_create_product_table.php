<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor')->index();
            $table->foreign('vendor')->references('id')->on('users')->onDelete('cascade');
            $table->string('productname', 50)->index();
            $table->string('image', 150)->nullable();
            $table->string('description', 150)->nullable();
            $table->decimal('price', 8, 2)->unsigned()->default(0);
            $table->integer('quantity')->unsigned()->default(0);
            $table->decimal('discount', 8, 2)->default(0);
            $table->tinyInteger('isavailable')->unsigned()->default(1);
            $table->dateTime('createdate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
