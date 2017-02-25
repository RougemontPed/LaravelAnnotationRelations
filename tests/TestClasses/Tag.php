<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphedByMany Post taggable
 * @MorphedByMany Video taggable
 */
class Tag extends Model
{
    use AnnotationRelationships;
}
