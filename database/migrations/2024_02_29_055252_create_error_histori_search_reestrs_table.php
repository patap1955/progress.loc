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
        Schema::create('error_histori_search_reestrs', function (Blueprint $table) {
            $table->id();
            $table->integer('code');
            $table->string('message');
            $table->timestamp('time');
            $table->bigInteger('reestr_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('error_histori_search_reestrs');
    }
};
