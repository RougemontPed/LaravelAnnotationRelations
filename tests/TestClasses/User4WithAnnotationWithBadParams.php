<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @BelongsToMany FirstClass SecondClass
 */
class User4WithAnnotationWithBadParams extends Model
{
    use AnnotationRelationships;
}
