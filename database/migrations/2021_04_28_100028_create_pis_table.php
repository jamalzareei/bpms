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
            $table->string('code')->unique();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('customer_id')->index();
            
            $table->timestamp('date');
            $table->bigInteger('sale_type_id');
            $table->text('address')->nullable();
            $table->string('delivery_location');
            $table->string('customer_name');
            $table->string('customer_name2');
            $table->string('number');
            $table->string('validity_date');
            $table->bigInteger('currency_id')->nullable();
            $table->decimal('currency_rate', 12, 2)->nullable();
            
            $table->text('details')->nullable();

            $table->timestamp('issud_at')->nullable();
            $table->timestamp('confirm_at')->nullable();
            $table->decimal('producing', 12, 2)->nullable();
            $table->decimal('stock', 12, 2)->nullable();
            $table->decimal('booking', 12, 2)->nullable();
            $table->decimal('trucks_factory', 12, 2)->nullable();
            $table->decimal('trucks_on_way', 12, 2)->nullable();
            $table->decimal('trucks_on_border', 12, 2)->nullable();
            $table->decimal('trucks_vend_on_way', 12, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
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
    }
}
