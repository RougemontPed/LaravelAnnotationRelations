<?php

namespace AndyDan\LaravelAnnotationRelations\Tests;

use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Country;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Post;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Town;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Town2;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Town3;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User5WithAnnotationWithBadParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User5WithAnnotationWithInvalidFirstParam;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User5WithAnnotationWithInvalidSecondParam;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User5WithAnnotationWithOneParam;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User5WithAnnotationWithoutArgs;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Video;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use PHPUnit\Framework\TestCase;

class HasManyThroughAnnotationRelationshipTest extends TestCase
{
    public function testRelationRetrieving()
    {
        $relation = (new Country)->posts();

        $this->assertInstanceOf(HasManyThrough::class, $relation);
        $this->assertInstanceOf(Post::class, $relation->getRelated());
        $this->assertInstanceOf(User::class, $relation->getParent());
        $this->assertEquals('users.country_id', $relation->getQualifiedFirstKeyName());
        $this->assertEquals('posts.user_id', $relation->getQualifiedForeignKeyName());
    }

    public function testRelationResolving()
    {
        $country = Country::create([]);
        $user = $country->user()->create([]);
        $post1 = $user->posts()->create([]);
        $post2 = $user->posts()->create([]);

        $posts = $country->posts;

        $this->assertCount(2, $posts);
        $this->assertEquals($posts->pluck('id')->toArray(), [$post1->id, $post2->id]);
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation should'nt be empty
     */
    public function testExceptionThrownCauseAnnotationWithNoArgs()
    {
        (new User5WithAnnotationWithoutArgs)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation params should only contain 2 related class names
     */
    public function testExceptionThrownCauseAnnotationWithOneParam()
    {
        (new User5WithAnnotationWithOneParam)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation params should only contain 2 related class names
     */
    public function testExceptionThrownCauseAnnotationWithBadParams()
    {
        (new User5WithAnnotationWithBadParams)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation params should only contain 2 related class names
     */
    public function testExceptionThrownCauseAnnotationWithInvalidFirstParam()
    {
        (new User5WithAnnotationWithInvalidFirstParam)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation params should only contain 2 related class names
     */
    public function testExceptionThrownCauseAnnotationWithInvalidSecondParam()
    {
        (new User5WithAnnotationWithInvalidSecondParam)->posts();
    }

    public function testWeCanDefineHasManyThroughAnnotationAsHasManyWithThreeParameters()
    {
        $relation = (new Town)->posts();

        $this->assertInstanceOf(HasManyThrough::class, $relation);
        $this->assertInstanceOf(Post::class, $relation->getRelated());
        $this->assertInstanceOf(User::class, $relation->getParent());
        $this->assertEquals('users.town_id', $relation->getQualifiedFirstKeyName());
        $this->assertEquals('posts.user_id', $relation->getQualifiedForeignKeyName());

        $town = Town::create([]);
        $user = $town->users()->create([]);
        $post1 = $user->posts()->create([]);
        $post2 = $user->posts()->create([]);

        $posts = $town->posts;

        $this->assertCount(2, $posts);
        $this->assertEquals($posts->pluck('id')->toArray(), [$post1->id, $post2->id]);
    }

    public function testHasManyThroughInTwoWays()
    {
        $relation = (new Town2)->posts();

        $this->assertInstanceOf(HasManyThrough::class, $relation);
        $this->assertInstanceOf(Post::class, $relation->getRelated());
        $this->assertInstanceOf(User::class, $relation->getParent());
        $this->assertEquals('users.town2_id', $relation->getQualifiedFirstKeyName());
        $this->assertEquals('posts.user_id', $relation->getQualifiedForeignKeyName());

        $town = Town2::create([]);
        $user = $town->users()->create([]);
        $post1 = $user->posts()->create([]);
        $post2 = $user->posts()->create([]);

        $posts = $town->posts;

        $this->assertCount(2, $posts);
        $this->assertEquals($posts->pluck('id')->toArray(), [$post1->id, $post2->id]);
    }

    public function testHasManyThroughWithManyAnnotations()
    {
        $postsRelation = (new Town3)->posts();

        $this->assertInstanceOf(HasManyThrough::class, $postsRelation);
        $this->assertInstanceOf(Post::class, $postsRelation->getRelated());
        $this->assertInstanceOf(User::class, $postsRelation->getParent());
        $this->assertEquals('users.town3_id', $postsRelation->getQualifiedFirstKeyName());
        $this->assertEquals('posts.user_id', $postsRelation->getQualifiedForeignKeyName());

        $town = Town3::create([]);
        $user = $town->users()->create([]);
        $post1 = $user->posts()->create([]);
        $post2 = $user->posts()->create([]);

        $posts = $town->posts;

        $this->assertCount(2, $posts);
        $this->assertEquals($posts->pluck('id')->toArray(), [$post1->id, $post2->id]);


        $videosRelation = (new Town3)->videos();

        $this->assertInstanceOf(HasManyThrough::class, $videosRelation);
        $this->assertInstanceOf(Video::class, $videosRelation->getRelated());
        $this->assertInstanceOf(User::class, $videosRelation->getParent());
        $this->assertEquals('users.town3_id', $videosRelation->getQualifiedFirstKeyName());
        $this->assertEquals('videos.user_id', $videosRelation->getQualifiedForeignKeyName());

        $video1 = $user->videos()->create([]);
        $video2 = $user->videos()->create([]);

        $videos = $town->videos;

        $this->assertCount(2, $videos);
        $this->assertEquals($videos->pluck('id')->toArray(), [$video1->id, $video2->id]);
    }
}
