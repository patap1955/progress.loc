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
        Schema::create('reestrs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_number')->nullable()->unique();
            $table->string('id_number')->nullable();
            $table->string('hash')->nullable();
            $table->integer('region_id')->nullable();
            $table->string('fio')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('inn')->nullable();
            $table->float('credit')->nullable();
            $table->float('real_credit')->nullable();
            $table->float('difference')->nullable();
            $table->json('line');
            $table->boolean('header');
            $table->boolean('upload_error');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reestrs');
    }
};
