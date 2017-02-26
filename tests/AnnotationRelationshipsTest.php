<?php

namespace AndyDan\LaravelAnnotationRelations;

use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Eye;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Hand;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Human;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Person;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Rabbit;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use PHPUnit\Framework\TestCase;

class AnnotationRelationshipsTest extends TestCase
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

    public function testWeCanDeclareFewRelationshipsThroughComma()
    {
        $hands = (new Rabbit)->hands();

        $this->assertInstanceOf(HasMany::class, $hands);
        $this->assertEquals('hands.rabbit_id', $hands->getQualifiedForeignKeyName());
        $this->assertInstanceOf(Hand::class, $hands->getRelated());

        $eyes = (new Rabbit)->eyes();

        $this->assertInstanceOf(HasMany::class, $eyes);
        $this->assertEquals('eyes.rabbit_id', $eyes->getQualifiedForeignKeyName());
        $this->assertInstanceOf(Eye::class, $eyes->getRelated());
    }
}
