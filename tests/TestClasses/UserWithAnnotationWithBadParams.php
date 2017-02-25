<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasOne FirstClass SecondClass
 */
class UserWithAnnotationWithBadParams extends Model
{
    use AnnotationRelationships;
}
