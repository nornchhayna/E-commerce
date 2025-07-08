<?php
// database/migrations/create_inventory_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTable extends Migration
{
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->enum('type', ['adjustment', 'sale', 'purchase', 'return']);
            $table->integer('quantity_change'); // positive or negative
            $table->integer('quantity_before');
            $table->integer('quantity_after');
            $table->string('reason')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // who made the change
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->index(['product_id', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory');
    }
}