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
        Schema::create('bookapps', function (Blueprint $table) {
            $table->id();
            $table->string('p_name');
            $table->string('p_phone');
            $table->string('p_depart');
            $table->string('p_email');
            $table->date('p_descrp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookapps');
    }
};
