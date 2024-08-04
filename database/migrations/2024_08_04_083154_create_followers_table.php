<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowersTable extends Migration
{
    public function up()
    {
        // Migration for the followers table
        Schema::create('followers', function (Blueprint $table) {
            $table->id()->unique(); // Ensure the ID is unique
            $table->string('name');
            $table->integer('age');
            $table->enum('gender', ['male', 'female']);
            $table->string('country');
            $table->string('email')->unique(); // Ensure the email is unique
            $table->string('phone')->unique(); // Ensure the phone number is unique
            $table->integer('followers_count');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
