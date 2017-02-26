<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasMany Hands, Eyes
 */
class Rabbit extends Model
{
    use AnnotationRelationships;
}
