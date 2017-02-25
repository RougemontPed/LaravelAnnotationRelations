<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphedByMany FirstClass
 */
class User7WithAnnotationInverseWithOneParam extends Model
{
    use AnnotationRelationships;
}
