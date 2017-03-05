<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @BelongsTo User
 * @MorphMany Comments commentable
 * @MorphMany Reviews
 * @MorphToMany Tags taggable
 */
class Post extends Model
{
    use AnnotationRelationships;
}
