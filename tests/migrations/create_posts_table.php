<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create('posts', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('user_id')->unsigned();
    $table->timestamps();
});

Capsule::schema()->create('post2s', function (Blueprint $table) {
    $table->increments('id');
    $table->timestamps();
});
