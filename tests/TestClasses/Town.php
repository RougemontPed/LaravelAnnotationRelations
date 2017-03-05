<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasMany Users
 * @HasMany Posts through User
 */
class Town extends Model
{
    use AnnotationRelationships;
}
