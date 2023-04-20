<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otherinformations', function (Blueprint $table) {
            $table->id();
            $table->string('school_name')->nullable(true);
            $table->string('school_id')->nullable(true);
            $table->string('district')->nullable(true);
            $table->string('division')->nullable(true);
            $table->string('region')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('otherinformations');
    }
};
