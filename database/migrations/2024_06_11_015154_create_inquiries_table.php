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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 512)->nullable()->comment('お名前');
            $table->string('tel', length: 32)->nullable()->comment('電話番号');
            $table->string('email', length: 254)->nullable()->comment('emailアドレス');
            $table->string('title', length: 256)->comment('タイトル');
            $table->text('body')->comment('本文');
            $table->datetimes();

            $table->comment('1レコードが「ユーザの1つの問い合わせ」を意味するテーブル');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
