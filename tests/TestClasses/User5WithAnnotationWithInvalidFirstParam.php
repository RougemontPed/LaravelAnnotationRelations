<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasManyThrough First^Class SecondClass
 */
class User5WithAnnotationWithInvalidFirstParam extends Model
{
    use AnnotationRelationships;
}
