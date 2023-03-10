<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("sale_id")->unsigned();
            $table->integer("book_id")->unsigned();
            $table->integer("quantity");
            $table->decimal("subtotal");
            $table->timestamps();

            $table->foreign("sale_id")->references("id")->on("sales");
            $table->foreign("book_id")->references("id")->on("books");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_details');
    }
};
