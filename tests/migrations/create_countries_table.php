<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create('countries', function (Blueprint $table) {
    $table->increments('id');
    $table->timestamps();
});
