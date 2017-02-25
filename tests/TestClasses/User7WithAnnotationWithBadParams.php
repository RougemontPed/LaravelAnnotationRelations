<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphToMany FirstClass owner another_parameter
 */
class User7WithAnnotationWithBadParams extends Model
{
    use AnnotationRelationships;
}
