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
        Schema::create('system_link', function (Blueprint $table) {
            $table->string('system_link_code')->index();
            $table->string('system_link_name');
            $table->string('system_link_action')->nullable();
            $table->string('system_link_controller')->nullable();
            $table->tinyInteger('system_link_sort')->nullable()->default(0);
            $table->string('system_link_description')->nullable();
            $table->tinyInteger('system_link_enable')->nullable();
            $table->string('system_link_url')->nullable();
            $table->tinyInteger('system_link_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_link');
    }
};
