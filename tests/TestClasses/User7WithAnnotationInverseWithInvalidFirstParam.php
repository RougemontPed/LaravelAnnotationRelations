<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphToMany First^Class owner
 */
class User7WithAnnotationInverseWithInvalidFirstParam extends Model
{
    use AnnotationRelationships;
}
