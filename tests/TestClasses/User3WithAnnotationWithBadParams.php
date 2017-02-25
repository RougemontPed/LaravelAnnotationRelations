<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @BelongsTo FirstClass SecondClass
 */
class User3WithAnnotationWithBadParams extends Model
{
    use AnnotationRelationships;
}
