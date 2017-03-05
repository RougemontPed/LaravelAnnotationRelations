<?php

namespace AndyDan\LaravelAnnotationRelations\Tests;

use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Post;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Post2;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Tag;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Tag2;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User7WithAnnotationInverseWithBadParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User7WithAnnotationInverseWithInvalidFirstParam;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User7WithAnnotationInverseWithoutArgs;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User7WithAnnotationWithBadParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User7WithAnnotationWithInvalidFirstParam;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User7WithAnnotationWithInvalidSecondParam;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User7WithAnnotationWithoutArgs;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Video;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Video2;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use PHPUnit\Framework\TestCase;

class ManyToManyPolymorphicAnnotationRelationshipTest extends TestCase
{
    public function testRelationRetrieving()
    {
        $relation = (new Post)->tags();

        $this->assertInstanceOf(MorphToMany::class, $relation);
        $this->assertInstanceOf(Tag::class, $relation->getRelated());
        $this->assertEquals('taggable_type', $relation->getMorphType());
        $this->assertEquals(Post::class, $relation->getMorphClass());
        $this->assertEquals('taggables', $relation->getTable());
        $this->assertEquals('taggables.taggable_id', $relation->getQualifiedForeignKeyName());
        $this->assertEquals('taggables.tag_id', $relation->getQualifiedRelatedKeyName());
//        $this->assertEquals('tags', $relation->getRelationName());

        $inverseRelation = (new Tag)->posts();

        $this->assertInstanceOf(MorphToMany::class, $inverseRelation);
        $this->assertInstanceOf(Post::class, $inverseRelation->getRelated());
        $this->assertEquals('taggable_type', $inverseRelation->getMorphType());
        $this->assertEquals(Post::class, $inverseRelation->getMorphClass());
        $this->assertEquals('taggables', $inverseRelation->getTable());
        $this->assertEquals('taggables.tag_id', $inverseRelation->getQualifiedForeignKeyName());
        $this->assertEquals('taggables.taggable_id', $inverseRelation->getQualifiedRelatedKeyName());
//        $this->assertEquals('posts', $inverseRelation->getRelationName());
    }

    public function testRelationResolving()
    {
        $user = User::create([]);

        $post = $user->posts()->create([]);
        $video = Video::create([]);
        $tag1 = $post->tags()->create([]);
        $tag2 = $post->tags()->create([]);
        $video->tags()->save($tag1);

        $this->assertCount(2, $post->tags);
        $this->assertTrue($post->tags[0]->is($tag1));
        $this->assertTrue($post->tags[1]->is($tag2));
        $this->assertTrue($tag1->videos[0]->is($video));
    }

    public function testMorphToMantRelationshipWithoutOwnerName()
    {
        $relation = (new Post2)->tag2s();

        $this->assertInstanceOf(MorphToMany::class, $relation);
        $this->assertInstanceOf(Tag2::class, $relation->getRelated());
        $this->assertEquals('tag2able_type', $relation->getMorphType());
        $this->assertEquals(Post2::class, $relation->getMorphClass());
        $this->assertEquals('tag2ables', $relation->getTable());
        $this->assertEquals('tag2ables.tag2able_id', $relation->getQualifiedForeignKeyName());
        $this->assertEquals('tag2ables.tag2_id', $relation->getQualifiedRelatedKeyName());

        $inverseRelation = (new Tag2)->post2s();

        $this->assertInstanceOf(MorphToMany::class, $inverseRelation);
        $this->assertInstanceOf(Post2::class, $inverseRelation->getRelated());
        $this->assertEquals('tag2able_type', $inverseRelation->getMorphType());
        $this->assertEquals(Post2::class, $inverseRelation->getMorphClass());
        $this->assertEquals('tag2ables', $inverseRelation->getTable());
        $this->assertEquals('tag2ables.tag2_id', $inverseRelation->getQualifiedForeignKeyName());
        $this->assertEquals('tag2ables.tag2able_id', $inverseRelation->getQualifiedRelatedKeyName());

        $post = Post2::create([]);
        $video = Video2::create([]);
        $tag1 = $post->tag2s()->create([]);
        $tag2 = $post->tag2s()->create([]);
        $video->tag2s()->save($tag1);

        $this->assertCount(2, $post->tag2s);
        $this->assertTrue($post->tag2s[0]->is($tag1));
        $this->assertTrue($post->tag2s[1]->is($tag2));
        $this->assertTrue($tag1->video2s[0]->is($video));
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation should'nt be empty
     */
    public function testExceptionThrownCauseAnnotationWithNoArgs()
    {
        (new User7WithAnnotationWithoutArgs)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation params should contain 1 or 2 parameters
     */
    public function testExceptionThrownCauseAnnotationWithBadParams()
    {
        (new User7WithAnnotationWithBadParams)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation should'nt be empty
     */
    public function testExceptionThrownCauseAnnotationInverseWithNoArgs()
    {
        (new User7WithAnnotationInverseWithoutArgs)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation params should contain 1 or 2 parameters
     */
    public function testExceptionThrownCauseAnnotationInverseWithBadParams()
    {
        (new User7WithAnnotationInverseWithBadParams)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation params should contain 2 parameters
     */
    public function testExceptionThrownCauseAnnotationWithInvalidFirstParam()
    {
        (new User7WithAnnotationWithInvalidFirstParam)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation params should contain 2 parameters
     */
    public function testExceptionThrownCauseAnnotationInverseWithInvalidFirstParam()
    {
        (new User7WithAnnotationInverseWithInvalidFirstParam)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation params should contain 2 parameters
     */
    public function testExceptionThrownCauseAnnotationWithInvalidSecondParam()
    {
        (new User7WithAnnotationWithInvalidSecondParam)->posts();
    }
}
