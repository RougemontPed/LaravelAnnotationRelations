<?php

namespace AndyDan\LaravelAnnotationRelations\Tests;

use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User5WithAnnotationWithBadParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User5WithAnnotationWithInvalidFirstParam;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User5WithAnnotationWithInvalidSecondParam;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User5WithAnnotationWithOneParam;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User5WithAnnotationWithoutArgs;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Country;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Post;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User;
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
        $this->assertEquals($country->posts->pluck('id')->toArray(), [$post1->id, $post2->id]);
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
}
