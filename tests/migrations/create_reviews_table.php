<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create('reviews', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('reviewable_id')->unsigned();
    $table->string('reviewable_type');
    $table->timestamps();
});
