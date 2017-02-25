<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @BelongsTo First^Class
 */
class User3WithAnnotationWithInvalidParams extends Model
{
    use AnnotationRelationships;
}
