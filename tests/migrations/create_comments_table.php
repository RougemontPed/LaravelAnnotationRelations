<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create('comments', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('commentable_id')->unsigned();
    $table->string('commentable_type');
    $table->timestamps();
});
