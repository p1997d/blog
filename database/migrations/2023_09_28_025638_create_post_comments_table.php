<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_comments', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->unsignedBigInteger('post_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('reply_id')->nullable();

            $table->index('post_id');
            $table->index('user_id');
            $table->index('reply_id');

            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('reply_id')->references('id')->on('post_comments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_comments');
    }
};
