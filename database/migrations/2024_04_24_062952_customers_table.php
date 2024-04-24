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
        Schema::create("customers", function (Blueprint $table) {
            $table->id()->primary();
            $table->string('username');
            $table->string('first');
            $table->string('last');
            $table->integer('phone')->unique();
            //username
            //first
            //last
            //phone

    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
