<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAccountIdFromReviewsTable extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('account_id');
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->nullable();
        });
    }
}
