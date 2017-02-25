<?php

namespace AndyDan\LaravelAnnotationRelations\Tests;

use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Post;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User2WithAnnotationWithBadParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User2WithAnnotationWithInvalidParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User2WithAnnotationWithoutArgs;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\UserWithAnnotationWithBadParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\UserWithAnnotationWithoutArgs;
use PHPUnit\Framework\TestCase;

class HasManyAnnotationRelationshipTest extends TestCase
{
    public function testRelationRetrieving()
    {
        $relation = (new User)->posts();

        $this->assertInstanceOf(Post::class, $relation->getRelated());
        $this->assertEquals('posts.user_id', $relation->getQualifiedForeignKeyName());
        $this->assertEquals('users.id', $relation->getQualifiedParentKeyName());
    }

    public function testRelationResolving()
    {
        $user = User::create([]);
        $user->posts()->create([]);
        $user->posts()->create([]);

        $posts = $user->posts;

        $this->assertCount(2, $posts);
        $this->assertEquals($user->id, $posts[0]->user_id);
        $this->assertEquals($user->id, $posts[1]->user_id);
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation definition should'nt be empty
     */
    public function testExceptionThrownCauseAnnotationWithNoArgs()
    {
        (new User2WithAnnotationWithoutArgs)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation parameters should only contain related class name
     */
    public function testExceptionThrownCauseAnnotationWithBadParams()
    {
        (new User2WithAnnotationWithBadParams)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation parameters should only contain related class name
     */
    public function testExceptionThrownCauseAnnotationWithInvalidParams()
    {
        (new User2WithAnnotationWithInvalidParams)->posts();
    }
}
