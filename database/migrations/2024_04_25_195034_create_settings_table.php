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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('product_key')->nullable()->default('null');
            $table->longText('token')->nullable()->default('null');
            $table->longText('table_list')->nullable()->default('null');
            $table->integer('filter_limit')->default(0);
            $table->longText('hdd')->nullable()->default('null');
            $table->integer('replac')->default(0);
            $table->integer('delay')->default(0);
            $table->string('name')->nullable()->default('null');
            $table->longText('value')->nullable()->default('null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
