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
        Schema::create('system_group_connection_menu', function (Blueprint $table) {
            $table->string('system_group_code');
            $table->string('system_menu_code');

            $table->primary(['system_group_code', 'system_menu_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_group_connection_menu');
    }
};
