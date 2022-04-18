<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_lists', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->unique();
            $table->bigInteger('uid');
            $table->string('email')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('name');
            $table->string('gender')->nullable();
            $table->string('country');
            $table->string('location')->nullable();
            $table->string('hometown')->nullable();
            $table->string('relationship_status')->nullable();
            $table->bigInteger('education_last_year')->nullable();
            $table->string('work')->nullable();
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
        Schema::dropIfExists('phone_lists');
    }
}
