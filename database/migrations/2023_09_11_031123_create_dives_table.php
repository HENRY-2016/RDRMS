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
        Schema::create('dives_table', function (Blueprint $table) {
            $table->id();
            $table->string('Student');
            $table->string('Date');
            $table->string('DiveNo');
            $table->string('Location');
            $table->string('Site');
            $table->string('TimeIn');
            $table->string('TimeOut');
            $table->string('Depth');
            $table->string('Instructor');
            $table->string('Equipments');
            $table->string('Remarks');
            $table->string('FeedBackStatus');
            $table->string('FeedBack');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dives_table');
    }
};
