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
        Schema::create('other_studentinfos', function (Blueprint $table) {
            $table->id();
            $table->string('lrn')->unique()->reference('lrn')->on('studentinfos');
            $table->string('pept_rating')->nullable()->default('');
            $table->string('pept_date_assestment')->nullable()->default('');
            $table->string('als_rating')->nullable()->default('');
            $table->string('als_name_address')->nullable()->default('');
            $table->string('others')->nullable()->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_studentinfos');
    }
};
