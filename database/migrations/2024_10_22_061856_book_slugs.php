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
        Schema::table('bookapps', function (Blueprint $table) {
            $table->string('slug')->after('p_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('bookapps');
        // Schema::table('bookapps', function (Blueprint $table) {
        //     $table->dropColumn('slug')->after('p_email');
        // });
    }
};
