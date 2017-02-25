<?php

namespace AndyDan\LaravelAnnotationRelations;

use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Human;
use Illuminate\Database\Eloquent\Relations\HasOne;
use PHPUnit\Framework\TestCase;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Person;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User;

class AnnotationRelationshipTest extends TestCase
{
    public function testOneRelationWorks()
    {
        $this->assertInstanceOf(HasOne::class, (new User)->phone());
    }

    public function testFewSameRelationsWorks()
    {
        $this->assertInstanceOf(HasOne::class, (new Person)->phone());
        $this->assertInstanceOf(HasOne::class, (new Person)->address());
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation can't found relation class UnknownClass
     */
    public function testExceptionThrownWhenTryToRelateUnknownClass()
    {
        (new Human)->unknownClass();
    }
}
