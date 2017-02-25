<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphToMany FirstClass
 */
class User7WithAnnotationWithOneParam extends Model
{
    use AnnotationRelationships;
}
