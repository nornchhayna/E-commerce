<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('title'); // Title column
            $table->text('description')->nullable(); // Description column, optional
            $table->boolean('status')->default(false); // Status column (e.g., true/false for completed/pending)
            $table->timestamps(); // Adds created_at and' updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('todos');
    }
};
