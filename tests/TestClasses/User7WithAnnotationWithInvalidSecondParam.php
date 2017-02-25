<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphedByMany FirstClass own^er
 */
class User7WithAnnotationWithInvalidSecondParam extends Model
{
    use AnnotationRelationships;
}
