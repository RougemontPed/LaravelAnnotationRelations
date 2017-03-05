<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasMany Users
 * @HasManyThrough Videos User
 * @HasMany Posts through User
 */
class Town2 extends Model
{
    use AnnotationRelationships;
}
