<?php

namespace AndyDan\LaravelAnnotationRelations\Tests;

use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User4WithAnnotationWithBadParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User4WithAnnotationWithInvalidParams;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User4WithAnnotationWithoutArgs;
use PHPUnit\Framework\TestCase;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\Role;
use AndyDan\LaravelAnnotationRelations\Tests\TestClasses\User;

class BelongsToManyAnnotationRelationshipTest extends TestCase
{
    public function testRelationRetrieving()
    {
        $relation = (new User)->roles();

        $this->assertInstanceOf(Role::class, $relation->getRelated());
        $this->assertEquals('role_user', $relation->getTable());
        $this->assertEquals('roles', $relation->getRelationName());
        $this->assertEquals('role_user.user_id', $relation->getQualifiedForeignKeyName());
        $this->assertEquals('role_user.role_id', $relation->getQualifiedRelatedKeyName());

        $inverseRelation= (new Role)->users();

        $this->assertInstanceOf(User::class, $inverseRelation->getRelated());
        $this->assertEquals('role_user', $inverseRelation->getTable());
        $this->assertEquals('users', $inverseRelation->getRelationName());
        $this->assertEquals('role_user.role_id', $inverseRelation->getQualifiedForeignKeyName());
        $this->assertEquals('role_user.user_id', $inverseRelation->getQualifiedRelatedKeyName());
    }

    public function testRelationResolving()
    {
        $user1 = User::create([]);
        $role1 = $user1->roles()->create([]);
        $role2 = $user1->roles()->create([]);
        $user2 = $role1->users()->create([]);

        $this->assertCount(2, $user1->roles);
        $this->assertCount(2, $role1->users);

        $this->assertEquals($user1->roles->pluck('id')->toArray(), [$role1->id, $role2->id]);
        $this->assertEquals($role1->users->pluck('id')->toArray(), [$user1->id, $user2->id]);
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation definition should'nt be empty
     */
    public function testExceptionThrownCauseAnnotationWithNoArgs()
    {
        (new User4WithAnnotationWithoutArgs)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation parameters should only contain related class name
     */
    public function testExceptionThrownCauseAnnotationWithBadParams()
    {
        (new User4WithAnnotationWithBadParams)->posts();
    }

    /**
     * @expectedException \AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException
     * @expectedExceptionMessage Annotation parameters should only contain related class name
     */
    public function testExceptionThrownCauseAnnotationWithInvalidParams()
    {
        (new User4WithAnnotationWithInvalidParams)->posts();
    }
}
