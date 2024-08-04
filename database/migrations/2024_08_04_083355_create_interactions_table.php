<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteractionsTable extends Migration
{
    public function up()
    {
        // Migration for the interactions table
        Schema::create('interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_id')->constrained('followers')->onDelete('cascade');
            $table->enum('type', ['like', 'comment']);
            $table->text('content')->nullable();
            $table->timestamp('timestamp')->index(); // Ensure the timestamp is indexed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('interactions');
    }
}
