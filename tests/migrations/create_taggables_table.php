<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->create('taggables', function (Blueprint $table) {
    $table->integer('tag_id')->unsigned();
    $table->integer('taggable_id')->unsigned();
    $table->string('taggable_type');
    $table->timestamps();
});
