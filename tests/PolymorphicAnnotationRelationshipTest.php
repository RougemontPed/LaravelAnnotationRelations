<?php

namespace AndyDan\LaravelAnnotationRelations\Tests;

use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\PostWithAnnotationWithBadParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\PostWithAnnotationWithInvalidParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\PostWithAnnotationWithoutArgs;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User6WithAnnotationWithBadParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User6WithAnnotationWithInvalidFirstParam;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User6WithAnnotationWithInvalidSecondParam;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User6WithAnnotationWithOneParam;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User6WithAnnotationWithoutArgs;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use PHPUnit\Framework\TestCase;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Comment;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Post;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Video;

class PolymorphicAnnotationRelationshipTest extends TestCase
{
    public function testRelationRetrieving()
    {
        $relation = (new Comment)->commentable();

        $this->assertInstanceOf(MorphTo::class, $relation);
        $this->assertInstanceOf(Comment::class, $relation->getRelated());
        $this->assertEquals('commentable_type', $relation->getMorphType());
        $this->assertEquals('comments.commentable_id', $relation->getQualifiedForeignKey());
        $this->assertEquals('commentable', $relation->getRelation());

        $inverseRelation = (new Post)->comments();

        $this->assertInstanceOf(MorphMany::class, $inverseRelation);
        $this->assertInstanceOf(Comment::class, $inverseRelation->getRelated());
        $this->assertEquals(Post::class, $inverseRelation->getMorphClass());
        $this->assertEquals('commentable_type', $inverseRelation->getMorphType());
        $this->assertEquals('posts.id', $inverseRelation->getQualifiedParentKeyName());
    }

    public function testRelationResolving()
    {
        $user = User::create([]);
        $post = $user->posts()->create([]);
        $video = Video::create([]);
        $comment1 = $post->comments()->create([]);
        $comment2 = $video->comments()->create([]);

        $this->assertTrue($comment1->commentable->is($post));
        $this->assertTrue($comment2->commentable->is($video));
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation should'nt be empty
     */
    public function testExceptionThrownCauseAnnotationWithNoArgs()
    {
        (new User6WithAnnotationWithoutArgs)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation params should contain 2 parameters
     */
    public function testExceptionThrownCauseAnnotationWithOneParam()
    {
        (new User6WithAnnotationWithOneParam)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation params should contain 2 parameters
     */
    public function testExceptionThrownCauseAnnotationWithBadParams()
    {
        (new User6WithAnnotationWithBadParams)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation params should contain 2 parameters
     */
    public function testExceptionThrownCauseAnnotationWithInvalidFirstParam()
    {
        (new User6WithAnnotationWithInvalidFirstParam)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation params should contain 2 parameters
     */
    public function testExceptionThrownCauseAnnotationWithInvalidSecondParam()
    {
        (new User6WithAnnotationWithInvalidSecondParam)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation should'nt be empty
     */
    public function testExceptionThrownCauseInverseAnnotationWithNoArgs()
    {
        (new PostWithAnnotationWithoutArgs)->comments();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation params should only contain owner
     */
    public function testExceptionThrownCauseInverseAnnotationWithBadParams()
    {
        (new PostWithAnnotationWithBadParams)->comments();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation params should only contain owner
     */
    public function testExceptionThrownCauseAnnotationWithInvalidParams()
    {
        (new PostWithAnnotationWithInvalidParams)->posts();
    }
}
