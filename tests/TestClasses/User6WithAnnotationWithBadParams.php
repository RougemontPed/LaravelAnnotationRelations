<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphMany FirstClass owner another_parameter
 */
class User6WithAnnotationWithBadParams extends Model
{
    use AnnotationRelationships;
}
