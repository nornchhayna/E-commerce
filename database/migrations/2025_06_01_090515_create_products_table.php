<?php
// database/migrations/create_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->string('sku')->unique();
            $table->decimal('price', 10, 2);
            $table->decimal('compare_price', 10, 2)->nullable();
            $table->decimal('cost_price', 10, 2)->nullable();
            $table->json('images')->nullable();
            $table->integer('weight')->nullable(); // in grams
            $table->json('dimensions')->nullable(); // length, width, height
            $table->boolean('track_inventory')->default(true);
            $table->integer('stock_quantity')->default(0);
            $table->integer('low_stock_threshold')->default(10);
            $table->enum('stock_status', ['in_stock', 'out_of_stock', 'backorder'])->default('in_stock');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->json('attributes')->nullable(); // color, size, etc.
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->index(['is_active', 'is_featured']);
            $table->index(['stock_status', 'is_active']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
