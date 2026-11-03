<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_reviews', function (Blueprint $table) {
            $table->dropForeign(['user_id']);

            $table->renameColumn('user_id', 'customer_id');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->cascadeOnDelete();
        });

        Schema::table('product_reviews', function (Blueprint $table) {
            $table->dropUnique(
                'product_reviews_product_user_order_unique'
            );

            $table->unique(
                ['product_id', 'customer_id', 'order_id'],
                'product_reviews_product_customer_order_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::table('product_reviews', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);

            $table->dropUnique(
                'product_reviews_product_customer_order_unique'
            );

            $table->renameColumn('customer_id', 'user_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });

        Schema::table('product_reviews', function (Blueprint $table) {
            $table->unique(
                ['product_id', 'user_id', 'order_id'],
                'product_reviews_product_user_order_unique'
            );
        });
    }
};
