<?php

namespace AndyDan\LaravelAnnotationRelations\Tests\TestClasses;

use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasOne \AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Phone
 * @HasOne Address
 */
class Person extends Model
{
    use AnnotationRelationships;
}
