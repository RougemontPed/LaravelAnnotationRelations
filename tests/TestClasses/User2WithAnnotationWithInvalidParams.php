<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasMany First^Classes
 */
class User2WithAnnotationWithInvalidParams extends Model
{
    use AnnotationRelationships;
}
