<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasOne User
 * @HasManyThrough Post User
 */
class Country extends Model
{
    use AnnotationRelationships;
}
