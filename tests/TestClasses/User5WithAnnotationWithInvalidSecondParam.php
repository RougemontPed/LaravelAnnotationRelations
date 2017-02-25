<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasManyThrough FirstClass Second^Class
 */
class User5WithAnnotationWithInvalidSecondParam extends Model
{
    use AnnotationRelationships;
}
