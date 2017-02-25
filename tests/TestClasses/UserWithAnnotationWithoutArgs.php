<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasOne
 */
class UserWithAnnotationWithoutArgs extends Model
{
    use AnnotationRelationships;
}
