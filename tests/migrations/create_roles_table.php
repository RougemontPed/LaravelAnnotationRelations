<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create('roles', function (Blueprint $table) {
    $table->increments('id');
    $table->timestamps();
});
