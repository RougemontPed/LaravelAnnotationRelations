<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasManyThrough FirstClass
 */
class User5WithAnnotationWithOneParam extends Model
{
    use AnnotationRelationships;
}
