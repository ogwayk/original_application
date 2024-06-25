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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id') //usersテーブルの外部キー設定
                ->constrained() //userテーブルのidカラムを参照するconstrainedメソッド
                ->onDelete('cascade'); //削除時のオプション

            $table->foreignId('post_id')
                ->constrained()
                ->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
