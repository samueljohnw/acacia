<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string("first_name");
            $table->string("last_name");
            $table->string("email");
            $table->string("phone");
            $table->string("address");
            $table->string("city");
            $table->string("state");
            $table->string("zip");
            $table->string("personalName");
            $table->string("personalEmail");
            $table->string("workName");
            $table->string("workPhone");
            $table->string("churchName");
            $table->string("churchPhone");
            $table->text("testimony");
            $table->text("history");
            $table->text("plans");
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
        Schema::drop('applications');
    }
}
