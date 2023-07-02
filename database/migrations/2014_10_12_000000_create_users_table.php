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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('middlename')->nullable(true);
            $table->string('lastname');
            $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('security_question', 500)->nullable(true);
            $table->text('security_answer', 500)->nullable(true);
            $table->string('admin_name')->default('')->nullable(true);
            $table->integer('role');
            $table->boolean('adviser')->default(false);
            $table->string('teacher_id')->default('N/A');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
