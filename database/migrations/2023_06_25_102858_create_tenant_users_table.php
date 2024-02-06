<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tenant_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tenant_id');
            $table->string('global_user_id');

            $table->unique(['tenant_id', 'global_user_id']);

            $table->foreign('tenant_id')->references('id')->on('tenants')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('global_user_id')->references('global_id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tenant_users');
    }
};
