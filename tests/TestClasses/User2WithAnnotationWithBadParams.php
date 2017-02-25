<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasMany FirstClasses SecondClasses
 */
class User2WithAnnotationWithBadParams extends Model
{
    use AnnotationRelationships;
}
