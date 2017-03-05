<?php

namespace AndyDan\LaravelAnnotationRelations\Tests;

use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Comment;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\OwnerNameGuesserExample;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Post;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\PostWithAnnotationWithBadParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\PostWithAnnotationWithInvalidParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Review;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User6WithAnnotationWithBadParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User6WithAnnotationWithInvalidFirstParam;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User6WithAnnotationWithInvalidSecondParam;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User6WithAnnotationWithoutArgs;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Video;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use PHPUnit\Framework\TestCase;

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

    public function testMorphToRelationshipWithoutOwnerName()
    {
        $relation = (new Review)->reviewable();

        $this->assertInstanceOf(MorphTo::class, $relation);
        $this->assertInstanceOf(Review::class, $relation->getRelated());
        $this->assertEquals('reviewable_type', $relation->getMorphType());
        $this->assertEquals('reviews.reviewable_id', $relation->getQualifiedForeignKey());
        $this->assertEquals('reviewable', $relation->getRelation());

        $user = User::create([]);
        $post = $user->posts()->create([]);
        $video = Video::create([]);
        $review1 = $post->reviews()->create([]);
        $review2 = $video->reviews()->create([]);

        $this->assertTrue($review1->reviewable->is($post));
        $this->assertTrue($review2->reviewable->is($video));
    }

    public function testOwnerNameGuesser()
    {
        $guesser = new OwnerNameGuesserExample;

        $this->assertEquals('reasonable', $guesser->tryToGuessOwnerName('reason'));
        $this->assertEquals('commentable', $guesser->tryToGuessOwnerName('comment'));
        $this->assertEquals('likable', $guesser->tryToGuessOwnerName('like'));
        $this->assertEquals('takable', $guesser->tryToGuessOwnerName('take'));
        $this->assertEquals('usable', $guesser->tryToGuessOwnerName('use'));
        $this->assertEquals('manageable', $guesser->tryToGuessOwnerName('manage'));
        $this->assertEquals('knowledgeable', $guesser->tryToGuessOwnerName('knowledge'));
        $this->assertEquals('judgeable', $guesser->tryToGuessOwnerName('judge'));
        $this->assertEquals('abridgeable', $guesser->tryToGuessOwnerName('abridge'));
        $this->assertEquals('noticeable', $guesser->tryToGuessOwnerName('notice'));
        $this->assertEquals('serviceable', $guesser->tryToGuessOwnerName('service'));
        $this->assertEquals('reliable', $guesser->tryToGuessOwnerName('rely'));
        $this->assertEquals('droppable', $guesser->tryToGuessOwnerName('drop'));
        $this->assertEquals('taggable', $guesser->tryToGuessOwnerName('tag'));
        $this->assertEquals('preferable', $guesser->tryToGuessOwnerName('prefer'));
        $this->assertEquals('bearable', $guesser->tryToGuessOwnerName('bear'));
        $this->assertEquals('readable', $guesser->tryToGuessOwnerName('read'));
        $this->assertEquals('acceptable', $guesser->tryToGuessOwnerName('accept'));
        $this->assertEquals('advisable', $guesser->tryToGuessOwnerName('advise'));
        $this->assertEquals('inflatable', $guesser->tryToGuessOwnerName('inflate'));
        $this->assertEquals('forgettable', $guesser->tryToGuessOwnerName('forget'));
        $this->assertEquals('forgettable', $guesser->tryToGuessOwnerName('forget'));
        $this->assertEquals('regrettable', $guesser->tryToGuessOwnerName('regret'));
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
     * @expectedExceptionMessage Annotation params should contain 1 or 2 parameters
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
