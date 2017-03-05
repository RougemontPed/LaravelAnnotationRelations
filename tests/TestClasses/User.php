<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasOne Phone
 * @HasMany Posts
 * @HasMany Videos
 * @BelongsToMany Roles
 */
class User extends Model
{
    use AnnotationRelationships;
}
