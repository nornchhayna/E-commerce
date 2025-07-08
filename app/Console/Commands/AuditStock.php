<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class AuditStock extends Command
{
    protected $signature = 'stock:audit {--fix : Fix negative stock values}';
    protected $description = 'Audit product stock levels and optionally fix negative values';

    public function handle()
    {
        $this->info('🔍 Auditing product stock levels...');

        $negativeStock = Product::where('stock_quantity', '<', 0)->get();
        $zeroStock = Product::where('stock_quantity', '=', 0)->get();
        $lowStock = Product::where('stock_quantity', '>', 0)->where('stock_quantity', '<=', 5)->get();

        // Show negative stock (critical)
        if ($negativeStock->isNotEmpty()) {
            $this->error("❌ Found {$negativeStock->count()} products with NEGATIVE stock:");
            $this->table(
                ['ID', 'Name', 'Stock'],
                $negativeStock->map(fn($p) => [$p->id, $p->name, $p->stock_quantity])->toArray()
            );
        } else {
            $this->info('✅ No products with negative stock found.');
        }

        // Show zero stock (warning)
        if ($zeroStock->isNotEmpty()) {
            $this->warn("⚠️  Found {$zeroStock->count()} products with ZERO stock:");
            $this->table(
                ['ID', 'Name', 'Stock'],
                $zeroStock->map(fn($p) => [$p->id, $p->name, $p->stock_quantity])->toArray()
            );
        }

        // Show low stock (info)
        if ($lowStock->isNotEmpty()) {
            $this->info("📊 Found {$lowStock->count()} products with LOW stock (1-5):");
            $this->table(
                ['ID', 'Name', 'Stock'],
                $lowStock->map(fn($p) => [$p->id, $p->name, $p->stock_quantity])->toArray()
            );
        }

        // Fix negative stock if requested
        if ($this->option('fix') && $negativeStock->isNotEmpty()) {
            if ($this->confirm('Do you want to set all negative stock values to 0?')) {
                Product::where('stock_quantity', '<', 0)->update(['stock_quantity' => 0]);
                $this->info("✅ Fixed {$negativeStock->count()} products with negative stock.");
            }
        } elseif ($negativeStock->isNotEmpty()) {
            $this->info('💡 Run with --fix option to correct negative stock values.');
        }

        $totalProducts = Product::count();
        $this->info("📈 Total products in database: {$totalProducts}");
    }
}
