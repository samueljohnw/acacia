<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('image')->default(null);
            $table->text('bio');
            $table->string('website');
            $table->string('slug')->unique();
            $table->string('status')->default('inactive');
            $table->string('type')->default('missionary');
            $table->string('country')->default('USA');
            $table->string('recipient_id')->default(null);
            $table->string('display_name');
            $table->boolean('verified')->default(0);
            $table->string('password', 60);
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
