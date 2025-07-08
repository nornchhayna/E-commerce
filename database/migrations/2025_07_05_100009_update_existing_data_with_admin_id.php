<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // If you have existing data, you can assign it to a default admin
        // First, make sure you have at least one admin user

        $defaultAdmin = DB::table('users')->where('role', 'admin')->first();

        if ($defaultAdmin) {
            // Update existing products
            DB::table('products')
                ->whereNull('admin_id')
                ->update(['admin_id' => $defaultAdmin->id]);

            // Update existing categories
            DB::table('categories')
                ->whereNull('admin_id')
                ->update(['admin_id' => $defaultAdmin->id]);

            // Update existing orders
            DB::table('orders')
                ->whereNull('admin_id')
                ->update(['admin_id' => $defaultAdmin->id]);

            // Update existing coupons
            DB::table('coupons')
                ->whereNull('admin_id')
                ->update(['admin_id' => $defaultAdmin->id]);

            // Update existing inventory
            DB::table('inventory')
                ->whereNull('admin_id')
                ->update(['admin_id' => $defaultAdmin->id]);

            // Update existing notifications
            DB::table('notifications')
                ->whereNull('admin_id')
                ->update(['admin_id' => $defaultAdmin->id]);

            // Update existing support tickets
            DB::table('support_tickets')
                ->whereNull('admin_id')
                ->update(['admin_id' => $defaultAdmin->id]);

            // Update existing reviews (get admin_id from product)
            DB::statement("
                UPDATE reviews r 
                JOIN products p ON r.product_id = p.id 
                SET r.admin_id = p.admin_id 
                WHERE r.admin_id IS NULL
            ");
        }
    }

    public function down()
    {
        // Set admin_id back to null for rollback
        DB::table('products')->update(['admin_id' => null]);
        DB::table('categories')->update(['admin_id' => null]);
        DB::table('orders')->update(['admin_id' => null]);
        DB::table('coupons')->update(['admin_id' => null]);
        DB::table('inventory')->update(['admin_id' => null]);
        DB::table('notifications')->update(['admin_id' => null]);
        DB::table('support_tickets')->update(['admin_id' => null]);
        DB::table('reviews')->update(['admin_id' => null]);
    }
};
