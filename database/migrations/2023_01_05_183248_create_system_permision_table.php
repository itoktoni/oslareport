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
        Schema::create('system_permision', function (Blueprint $table) {
            $table->integer('system_permision_id', true);
            $table->string('system_permision_role')->nullable();
            $table->string('system_permision_code')->nullable();
            $table->string('system_permision_controller')->nullable();
            $table->string('system_permision_module')->nullable()->default('1');
            $table->integer('system_permision_user')->nullable();
            $table->tinyInteger('system_permision_level')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_permision');
    }
};
