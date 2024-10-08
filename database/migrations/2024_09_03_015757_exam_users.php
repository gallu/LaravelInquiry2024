<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// php artisan make:migration exam_users

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('exam_users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('お名前');
            $table->string('email', 254)->comment('emailアドレス');
            $table->text('memo')->nullable()->comment('めも');
            $table->datetimes();

            $table->comment('前期試験用テーブル');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('exam_users');
    }
};
