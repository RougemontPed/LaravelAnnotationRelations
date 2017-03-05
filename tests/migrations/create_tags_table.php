<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create('tags', function (Blueprint $table) {
    $table->increments('id');
    $table->timestamps();
});

Capsule::schema()->create('tag2s', function (Blueprint $table) {
    $table->increments('id');
    $table->timestamps();
});
