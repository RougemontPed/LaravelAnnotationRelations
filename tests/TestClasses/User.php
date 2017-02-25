<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasOne Phone
 * @HasMany Posts
 * @BelongsToMany Roles
 */
class User extends Model
{
    use AnnotationRelationships;
}
