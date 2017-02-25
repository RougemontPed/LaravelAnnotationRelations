<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasOne First^Class
 */
class UserWithAnnotationWithInvalidParams extends Model
{
    use AnnotationRelationships;
}
