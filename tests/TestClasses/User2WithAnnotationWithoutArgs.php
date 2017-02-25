<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasMany
 */
class User2WithAnnotationWithoutArgs extends Model
{
    use AnnotationRelationships;
}
