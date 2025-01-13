<?php

declare(strict_types=1);

use App\Enums\ProductStatus;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('user_id')->constrained('users')->nullOnDelete();
            $table->text('content');
            $table->integer('price')->nullable(); // if no variants exist
            $table->integer('stock')->nullable(); // if no variants exist
            $table->enum('status', [ProductStatus::values()]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
