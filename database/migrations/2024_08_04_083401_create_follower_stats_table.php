<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowerStatsTable extends Migration
{
    public function up()
    {
        // Migration for the follower_stats table
        Schema::create('follower_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_id')->constrained('followers')->onDelete('cascade');
            $table->date('date_followed'); // Ensure the combination is unique
            $table->integer('likes')->default(0);
            $table->integer('comments')->default(0);
            $table->integer('posts')->default(0);
            $table->decimal('engagement_rate', 5, 2)->default(0.00);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('follower_stats');
    }
}
