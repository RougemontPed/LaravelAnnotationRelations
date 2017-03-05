<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphedByMany Post2
 * @MorphedByMany Video2
 */
class Tag2 extends Model
{
    use AnnotationRelationships;
}
