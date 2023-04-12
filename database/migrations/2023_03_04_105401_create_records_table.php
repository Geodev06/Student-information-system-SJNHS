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
            $table->string('school');
            $table->string('school_id');
            $table->string('district');
            $table->string('division');
            $table->string('region');
            $table->string('classified_grade');
            $table->string('section');
            $table->string('school_year');
            $table->string('adviser');
            $table->json('data')->nullable();
            $table->string('remedial_date_from')->nullable();
            $table->string('remedial_date_to')->nullable();
            $table->json('remedials')->nullable();
            $table->decimal('gen_ave', 12, 2);
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
