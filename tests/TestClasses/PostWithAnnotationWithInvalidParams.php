<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphTo ow&ner
 */
class PostWithAnnotationWithInvalidParams extends Model
{
    use AnnotationRelationships;
}
