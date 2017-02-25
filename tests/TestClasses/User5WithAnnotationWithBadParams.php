<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasManyThrough FirstClass SecondClass ThirdClass
 */
class User5WithAnnotationWithBadParams extends Model
{
    use AnnotationRelationships;
}
