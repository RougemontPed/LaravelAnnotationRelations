<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphedByMany FirstClass owner another_parameter
 */
class User7WithAnnotationInverseWithBadParams extends Model
{
    use AnnotationRelationships;
}
