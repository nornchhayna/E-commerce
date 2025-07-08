<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Add column if it doesn't exist
            if (!Schema::hasColumn('products', 'store_id')) {
                $table->unsignedBigInteger('store_id')->after('id');
            }

            // Add the correct foreign key constraint
            $table->foreign('store_id')
                ->references('id')
                ->on('stores') // ✅ Fix here: should be 'stores', not 'users'
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['store_id']);
            // Optional: $table->dropColumn('store_id');
        });
    }
};
