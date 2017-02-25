<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphMany
 */
class User6WithAnnotationWithoutArgs extends Model
{
    use AnnotationRelationships;
}
