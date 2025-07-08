<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Global site settings table
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, number, boolean, json, file
            $table->string('group')->default('general'); // general, payment, shipping, email, seo
            $table->string('label');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Addresses table (your existing schema)
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('type', ['billing', 'shipping'])->default('billing');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('zip');
            $table->string('country');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        // Payment methods configuration
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->json('config')->nullable(); // Store API keys, settings, etc.
            $table->boolean('is_active')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Shipping methods configuration
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->decimal('base_cost', 8, 2)->default(0);
            $table->decimal('cost_per_kg', 8, 2)->default(0);
            $table->json('countries')->nullable(); // Supported countries
            $table->boolean('is_active')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipping_methods');
        Schema::dropIfExists('payment_methods');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('site_settings');
    }
};
