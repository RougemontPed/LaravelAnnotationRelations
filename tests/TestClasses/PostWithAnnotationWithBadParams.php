<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphTo To many params
 */
class PostWithAnnotationWithBadParams extends Model
{
    use AnnotationRelationships;
}
