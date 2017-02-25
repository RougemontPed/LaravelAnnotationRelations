<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphMany First^Class owner
 */
class User6WithAnnotationWithInvalidFirstParam extends Model
{
    use AnnotationRelationships;
}
