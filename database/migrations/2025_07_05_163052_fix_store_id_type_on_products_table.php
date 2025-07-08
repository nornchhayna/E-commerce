<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Change store_id to unsignedBigInteger and not nullable
            $table->unsignedBigInteger('store_id')->nullable(false)->change();
            $table->unsignedBigInteger('store_id')->nullable()->change();

            // Add foreign key
            $table->foreign('store_id')
                ->references('id')
                ->on('stores')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['store_id']);
            // Optional: revert store_id to signed nullable if needed
            $table->bigInteger('store_id')->nullable()->change();
        });
    }
};
