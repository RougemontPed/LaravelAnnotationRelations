<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create('towns', function (Blueprint $table) {
    $table->increments('id');
    $table->timestamps();
});

Capsule::schema()->create('town2s', function (Blueprint $table) {
    $table->increments('id');
    $table->timestamps();
});

Capsule::schema()->create('town3s', function (Blueprint $table) {
    $table->increments('id');
    $table->timestamps();
});
