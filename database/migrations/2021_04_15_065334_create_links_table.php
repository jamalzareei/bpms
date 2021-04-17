<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('name', 191);
            $table->string('slug', 191);
            $table->string('place_link', 191)->nullable();
            $table->string('route_name', 191)->nullable();
            $table->text('url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('link_role', function (Blueprint $table) {
            $table->bigInteger('link_id');
            $table->bigInteger('role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('links');
        Schema::dropIfExists('link_role');
    }
}
