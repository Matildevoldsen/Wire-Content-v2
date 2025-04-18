<?php

declare(strict_types=1);

use App\Enums\ArticleStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable();
            $table->enum('status', [ArticleStatus::values()])
                ->default(ArticleStatus::DRAFT)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('deleted_at', 'status');
        });
    }
};
