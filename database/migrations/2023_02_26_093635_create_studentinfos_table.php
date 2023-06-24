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
        Schema::create('studentinfos', function (Blueprint $table) {
            $table->id();
            $table->string('lrn')->unique()->index();
            $table->string('firstname');
            $table->string('middlename')->nullable()->default('');
            $table->string('lastname');
            $table->string('name_ext')->nullable()->default('');
            $table->string('birthdate');
            $table->integer('sex');

            $table->string('elem_school');
            $table->string('elem_school_id');
            $table->string('elem_school_citation')->nullable()->default('');
            $table->string('elem_school_address');
            $table->integer('gen_ave');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentinfos');
    }
};
