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
        Schema::create('histori_search_reestr_ids', function (Blueprint $table) {
            $table->id();
            $table->string('id_number')->nullable();
            $table->string('fio')->nullable();
            $table->string('hash')->nullable();
            $table->string('status')->nullable();
            $table->string('credit')->nullable();
            $table->json('line');
            $table->integer('header');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histori_search_reestr_ids');
    }
};
