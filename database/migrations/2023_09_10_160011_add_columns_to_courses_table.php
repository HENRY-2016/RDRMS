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
        Schema::table('courses_table', function (Blueprint $table) {
            $table->text('Requirement1');
            $table->text('Requirement2');
            $table->text('Requirement3');
            $table->text('Requirement4');
            $table->text('Requirement5');
            $table->text('Requirement6');
            $table->text('Requirement7');
            $table->text('Requirement8');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses_table', function (Blueprint $table) {
            $table->dropColumn('Requirement1');
            $table->dropColumn('Requirement2');
            $table->dropColumn('Requirement3');
            $table->dropColumn('Requirement4');
            $table->dropColumn('Requirement5');
            $table->dropColumn('Requirement6');
            $table->dropColumn('Requirement7');
            $table->dropColumn('Requirement8');
        });
    }
};
