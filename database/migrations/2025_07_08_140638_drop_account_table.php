<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAccountTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('account');
    }

    public function down()
    {
        // Optionally, you can add code here to recreate the table if needed
        Schema::create('account', function (Blueprint $table) {
            $table->id();
            // Add other columns as needed
            $table->timestamps();
        });
    }
}
