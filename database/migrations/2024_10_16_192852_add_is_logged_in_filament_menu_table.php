<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(config('filament-menu-builder.tables.menus'), function (Blueprint $table) {
            $table->boolean('is_logged_in')->default(false);
        });

        Schema::table(config('filament-menu-builder.tables.menu_items'), function (Blueprint $table) {
            $table->string('classes')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->boolean('use_navigate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(config('filament-menu-builder.tables.menus'), function (Blueprint $table) {
            $table->dropColumn('is_logged_in');
        });

        Schema::table(config('filament-menu-builder.tables.menu_items'), function (Blueprint $table) {
            $table->dropColumn('classes');
        });
    }
};
