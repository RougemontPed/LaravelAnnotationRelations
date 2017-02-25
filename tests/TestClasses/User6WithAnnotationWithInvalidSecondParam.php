<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphMany FirstClass ow^ner
 */
class User6WithAnnotationWithInvalidSecondParam extends Model
{
    use AnnotationRelationships;
}
