<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphToMany
 */
class User7WithAnnotationWithoutArgs extends Model
{
    use AnnotationRelationships;
}
