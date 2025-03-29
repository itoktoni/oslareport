<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_menu_connection_link', function (Blueprint $table) {
            $table->string('system_menu_code')->index('system_menu_connection_link_ibfk_1');
            $table->string('system_link_code')->index('system_menu_connection_link_ibfk_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_menu_connection_link');
    }
};
