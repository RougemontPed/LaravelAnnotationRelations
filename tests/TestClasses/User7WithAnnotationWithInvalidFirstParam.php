<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphedByMany First^Class owner
 */
class User7WithAnnotationWithInvalidFirstParam extends Model
{
    use AnnotationRelationships;
}
