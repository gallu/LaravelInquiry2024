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
        Schema::table('inquiries', function (Blueprint $table) {
            $table->string('reply_status', 128)->nullable()->comment('返信ステータス');
            $table->text('reply_body')->comment('返信内容');
            $table->datetime('reply_at')->nullable()->comment('返信日時');
            $table->unsignedBigInteger('reply_admin_id')->nullable()->comment('返信担当者ID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropColumn('reply_status');
            $table->dropColumn('reply_body');
            $table->dropColumn('reply_at');
            $table->dropColumn('reply_admin_id');
        });
    }
};
