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
        Schema::table('students_table', function (Blueprint $table) {
            $table->text('Gender');
            $table->text('EntryYear');
            $table->text('StudentId');
            $table->text('Course');
            $table->text('Address');
            $table->text('Image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students_table', function (Blueprint $table) {
            $table->dropColumn('Gender');
            $table->dropColumn('EntryYear');
            $table->dropColumn('StudentId');
            $table->dropColumn('Course');
            $table->dropColumn('Address');
            $table->dropColumn('Image');
        });
    }
};
