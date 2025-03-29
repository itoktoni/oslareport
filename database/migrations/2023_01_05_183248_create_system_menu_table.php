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
        Schema::create('system_menu', function (Blueprint $table) {
            $table->string('system_menu_code')->index('system_menu_code');
            $table->string('system_menu_name');
            $table->string('system_menu_url')->nullable();
            $table->string('system_menu_controller')->nullable();
            $table->string('system_menu_action')->nullable();
            $table->tinyInteger('system_menu_type')->nullable()->default(5);
            $table->tinyInteger('system_menu_sort')->nullable();
            $table->string('system_menu_description')->nullable();
            $table->boolean('system_menu_enable')->nullable();
            $table->boolean('system_menu_can_delete')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_menu');
    }
};
