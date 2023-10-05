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
        Schema::table('safety_table', function (Blueprint $table) {
            $table->text('Safety1');
            $table->text('Safety2');
            $table->text('Safety3');
            $table->text('Safety4');
            $table->text('Safety5');
            $table->text('Safety6');
            $table->text('Safety7');
            $table->text('Safety8');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('safety_table', function (Blueprint $table) {
            $table->dropColumn('Safety1');
            $table->dropColumn('Safety2');
            $table->dropColumn('Safety3');
            $table->dropColumn('Safety4');
            $table->dropColumn('Safety5');
            $table->dropColumn('Safety6');
            $table->dropColumn('Safety7');
            $table->dropColumn('Safety8');
        });
    }
};
