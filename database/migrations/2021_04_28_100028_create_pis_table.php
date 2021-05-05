<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pis', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->timestamp('issud_at');
            $table->timestamp('confirm_at');
            $table->decimal('producing', 12, 2);
            $table->decimal('stock', 12, 2);
            $table->decimal('booking', 12, 2);
            $table->decimal('trucks_factory', 12, 2);
            $table->decimal('trucks_on_way', 12, 2);
            $table->decimal('trucks_on_border', 12, 2);
            $table->decimal('trucks_vend_on_way', 12, 2);
            $table->timestamps();
            $table->softDeletes();
        });

        
        Schema::create('customer_pi', function (Blueprint $table) {
            $table->bigInteger('customer_id');
            $table->bigInteger('pi_id');
        });
        
        Schema::create('pi_product', function (Blueprint $table) {
            $table->bigInteger('pi_id');
            $table->bigInteger('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pis');
        Schema::dropIfExists('customer_pi');
        Schema::dropIfExists('pi_product');
    }
}
