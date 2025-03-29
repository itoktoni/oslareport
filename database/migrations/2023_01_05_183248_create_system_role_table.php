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
        Schema::create('system_role', function (Blueprint $table) {
            $table->string('system_role_code')->primary();
            $table->string('system_role_name');
            $table->string('system_role_description')->nullable();
            $table->tinyInteger('system_role_level')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_role');
    }
};
