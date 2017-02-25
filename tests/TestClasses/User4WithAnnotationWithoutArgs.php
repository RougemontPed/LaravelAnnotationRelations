<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @BelongsToMany
 */
class User4WithAnnotationWithoutArgs extends Model
{
    use AnnotationRelationships;
}
