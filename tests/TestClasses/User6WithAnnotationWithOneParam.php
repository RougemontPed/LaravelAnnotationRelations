<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphMany FirstClass
 */
class User6WithAnnotationWithOneParam extends Model
{
    use AnnotationRelationships;
}
