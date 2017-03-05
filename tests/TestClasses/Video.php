<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphMany Comments commentable
 * @MorphMany Reviews
 * @MorphToMany Tags taggable
 */
class Video extends Model
{
    use AnnotationRelationships;
}
