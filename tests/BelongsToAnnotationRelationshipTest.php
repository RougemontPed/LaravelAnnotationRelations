<?php

namespace AndyDan\LaravelAnnotationRelations\Tests;

use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Phone;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User3WithAnnotationWithBadParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User3WithAnnotationWithInvalidParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User3WithAnnotationWithoutArgs;
use PHPUnit\Framework\TestCase;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Post;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User;

class BelongsToAnnotationRelationshipTest extends TestCase
{
    public function testBelongsToOneRelationRetrieving()
    {
        $relation = (new Phone)->user();

        $this->assertInstanceOf(User::class, $relation->getRelated());
        $this->assertEquals('user', $relation->getRelation());
        $this->assertEquals('id', $relation->getOwnerKey());
        $this->assertEquals('user_id', $relation->getForeignKey());
    }

    public function testBelongsToOneRelationResolving()
    {
        $user = User::create([]);
        $phone = $user->phone()->create([]);

        $this->assertEquals($phone->user_id, $phone->user->id);
    }

    public function testBelongsToManyRelationRetrieving()
    {
        $relation = (new Post)->user();

        $this->assertInstanceOf(User::class, $relation->getRelated());
        $this->assertEquals('user', $relation->getRelation());
        $this->assertEquals('id', $relation->getOwnerKey());
        $this->assertEquals('user_id', $relation->getForeignKey());
    }

    public function testBelongsToManyRelationResolving()
    {
        $user = User::create([]);
        $post = $user->posts()->create([]);

        $this->assertEquals($post->user_id, $post->user->id);
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation definition should'nt be empty
     */
    public function testExceptionThrownCauseAnnotationWithNoArgs()
    {
        (new User3WithAnnotationWithoutArgs)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation parameters should only contain related class name
     */
    public function testExceptionThrownCauseAnnotationWithBadParams()
    {
        (new User3WithAnnotationWithBadParams)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation parameters should only contain related class name
     */
    public function testExceptionThrownCauseAnnotationWithInvalidParams()
    {
        (new User3WithAnnotationWithInvalidParams)->posts();
    }
}
