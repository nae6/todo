<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsCompletedToTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('todos', function (Blueprint $table) {
            // 完了フラグ（未完了がデフォルト）
            $table->boolean('is_done')
                ->default(false)
                ->after('content');

            // 完了日時（未完了の間は null）
            $table->timestamp('completed_at')
                ->nullable()
                ->after('is_done');

            // ユーザー紐付け
            $table->foreignId('user_id')
                ->after('completed_at')
                ->constrained()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'user_id',
                'completed_at',
                'is_done',
            ]);
        });
    }
}
