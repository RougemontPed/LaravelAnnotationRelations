<?php

namespace AndyDan\LaravelAnnotationRelations\Tests;

use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Phone;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\UserWithAnnotationWithBadParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\UserWithAnnotationWithInvalidParams;
use PHPUnit\Framework\TestCase;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\UserWithAnnotationWithoutArgs;

class HasOneAnnotationRelationshipTest extends TestCase
{
    public function testRelationRetrieving()
    {
        $relation = (new User)->phone();

        $this->assertInstanceOf(Phone::class, $relation->getRelated());
        $this->assertEquals('phones.user_id', $relation->getQualifiedForeignKeyName());
    }

    public function testRelationResolving()
    {
        $user = User::create([]);
        $user->phone()->create([]);

        $this->assertEquals($user->id, $user->phone->user_id);
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation definition should'nt be empty
     */
    public function testExceptionThrownCauseAnnotationWithNoArgs()
    {
        (new UserWithAnnotationWithoutArgs)->phone();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation parameters should only contain related class name
     */
    public function testExceptionThrownCauseAnnotationWithBadParams()
    {
        (new UserWithAnnotationWithBadParams)->phone();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation parameters should only contain related class name
     */
    public function testExceptionThrownCauseAnnotationWithInvalidParams()
    {
        (new UserWithAnnotationWithInvalidParams)->posts();
    }
}
