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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('lrn')->reference('lrn')->on('studentinfos');
            $table->integer('sex'); // 0 - male 1- female
            $table->string('age')->nullable(true);
            $table->string('school');
            $table->string('school_id');
            $table->string('district');
            $table->string('division');
            $table->string('region');
            $table->string('classified_grade');
            $table->string('section');
            $table->string('section_id');
            $table->string('school_year');
            $table->string('adviser');
            $table->json('data')->nullable();
            $table->string('remedial_date_from')->nullable();
            $table->string('remedial_date_to')->nullable();
            $table->json('remedials')->nullable();
            $table->string('gen_ave');
            $table->integer('default')->default(0);
            $table->json('attendance')->nullable(true);
            $table->json('observed_values')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
