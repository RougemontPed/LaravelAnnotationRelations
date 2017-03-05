<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasMany Users
 * @HasMany Posts through User
 * @HasMany Videos through User
 */
class Town3 extends Model
{
    use AnnotationRelationships;
}
