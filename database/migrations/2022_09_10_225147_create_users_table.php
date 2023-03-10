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
        Schema::create('users', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->string("surname");
            $table->integer("dni");
            $table->integer("phone");
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer("role_id")->unsigned();
            $table->string("image")->nullable();
            $table->integer("state");
            $table->rememberToken();
            $table->timestamps();

            $table->foreign("role_id")->references("id")->on("roles");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
