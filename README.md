# Laravel annotation relations

[![Latest Version on Packagist](https://img.shields.io/packagist/v/andydan/laravel-annotation-relations.svg)](https://packagist.org/packages/andydan/laravel-annotation-relations)
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status](https://coveralls.io/repos/github/andydan/LaravelAnnotationRelations/badge.svg?branch=master)](https://coveralls.io/github/andydan/LaravelAnnotationRelations?branch=master)
[![StyleCI](https://styleci.io/repos/82421206/shield?branch=master)](https://styleci.io/repos/82421206)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/andydan/LaravelAnnotationRelations/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/andydan/LaravelAnnotationRelations/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/andydan/laravel-annotation-relations.svg)](https://packagist.org/packages/andydan/laravel-annotation-relations)

Annotation relationships for Laravel 5

## Install

Via Composer

``` bash
$ composer require andydan/laravel-annotation-relations
```

## Usage

### One To One

``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasOne Phone
 */
class User extends Model
{
    use AnnotationRelationships;
}
```
``` php
$phone = User::first()->phone;
```
``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @BelongsTo User
 */
class Phone extends Model
{
    use AnnotationRelationships;
}
```
``` php
$user = Phone::first()->user;
```

### One To Many

``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasMany Comments
 */
class Post extends Model
{
    use AnnotationRelationships;
}
```
``` php
$comments = Post::first()->comments;
```
``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @BelongsTo Post
 */
class Comment extends Model
{
    use AnnotationRelationships;
}
```
``` php
$post = Comment::first()->post;
```

### Many To Many

``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @BelongsToMany Roles
 */
class User extends Model
{
    use AnnotationRelationships;
}
```
``` php
$roles = User::first()->roles;
```
``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @BelongsToMany Users
 */
class Role extends Model
{
    use AnnotationRelationships;
}
```
``` php
$users = Role::first()->users;
```

### Has Many Through

``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasManyThrough Post User
 */
class Country extends Model
{
    use AnnotationRelationships;
}
```
``` php
$posts = Country::first()->posts;
```

### Polymorphic Relations

``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphTo commentable
 */
class Comment extends Model
{
    use AnnotationRelationships;
}
```
``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphMany Comments commentable
 */
class Post extends Model
{
    use AnnotationRelationships;
}
```
``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphMany Comments commentable
 */
class Video extends Model
{
    use AnnotationRelationships;
}
```
``` php
$comments = Post::first()->comments;
$comments = Video::first()->comments;

$commentable = Comment::first()->commentable
```

### Many To Many Polymorphic Relations

``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphToMany Tags taggable
 */
class Post extends Model
{
    use AnnotationRelationships;
}
```
``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphToMany Tags taggable
 */
class Video extends Model
{
    use AnnotationRelationships;
}
```
``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphedByMany Post taggable
 * @MorphedByMany Video taggable
 */
class Tag extends Model
{
    use AnnotationRelationships;
}
```
``` php
$tags = Post::first()->tags;
$tags = Video::first()->tags;

$posts = Tag::first()->posts;
$videos = Tag::first()->videos;
```

You can also define multiple annotation relationships on one model

``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasOne Phone
 * @HasOne Address
 * @HasMany Posts
 */
class User extends Model
{
    use AnnotationRelationships;
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email andydaneq@gmail.com instead of using the issue tracker.

## Credits

- [Andy Dan][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/andydan/LaravelAnnotationRelations.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/andydan/LaravelAnnotationRelations/master.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/andydan/LaravelAnnotationRelations.svg?style=flat-square
[link-packagist]: https://packagist.org/packages/andydan/LaravelAnnotationRelations
[link-travis]: https://travis-ci.org/andydan/LaravelAnnotationRelations
[link-downloads]: https://packagist.org/packages/andydan/LaravelAnnotationRelations
[link-author]: https://github.com/andydan
[link-contributors]: ../../contributors
