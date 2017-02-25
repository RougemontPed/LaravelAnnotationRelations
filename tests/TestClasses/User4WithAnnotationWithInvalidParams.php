<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @BelongsToMany First^Class
 */
class User4WithAnnotationWithInvalidParams extends Model
{
    use AnnotationRelationships;
}
