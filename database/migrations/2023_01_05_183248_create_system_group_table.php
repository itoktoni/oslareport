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
        Schema::create('system_group', function (Blueprint $table) {
            $table->string('system_group_code')->primary();
            $table->string('system_group_name')->nullable();
            $table->integer('system_group_sort')->nullable()->default(0);
            $table->boolean('system_group_enable')->nullable()->default(true);
            $table->string('system_group_url')->nullable();
            $table->string('system_group_icon')->nullable();
            $table->string('system_group_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_group');
    }
};
