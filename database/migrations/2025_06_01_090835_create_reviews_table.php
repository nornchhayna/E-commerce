<?php
// database/migrations/create_reviews_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->integer('rating'); // 1-5 stars
            $table->string('title')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('is_verified')->default(false); // verified purchase
            $table->boolean('is_approved')->default(false);
            $table->json('images')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('set null');
            $table->unique(['product_id', 'user_id', 'order_id']);
            $table->index(['product_id', 'is_approved']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}