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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('item')->nullable()->default(null);
            $table->text('url');
            $table->text('title')->nullable()->default(null);
            $table->text('subject')->nullable()->default(null);
            $table->text('body')->nullable()->default(null);
            $table->integer('sender_id')->default(-1);
            $table->string('feed_id')->nullable()->default(null);
            $table->string('feed_date')->nullable()->default(null);
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
