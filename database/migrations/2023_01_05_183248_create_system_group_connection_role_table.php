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
        Schema::create('system_group_connection_role', function (Blueprint $table) {
            $table->string('system_role_code');
            $table->string('system_group_code')->index('system_group_connection_role_ibfk_2');

            $table->primary(['system_role_code', 'system_group_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_group_connection_role');
    }
};
