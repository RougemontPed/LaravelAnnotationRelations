<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphedByMany
 */
class User7WithAnnotationInverseWithoutArgs extends Model
{
    use AnnotationRelationships;
}
