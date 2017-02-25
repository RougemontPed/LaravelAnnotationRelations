<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create('role_user', function (Blueprint $table) {
    $table->integer('user_id')->unsigned();
    $table->integer('role_id')->unsigned();
    $table->timestamps();

    $table->primary(['user_id', 'role_id']);
});
