# Laravel annotation relations (a fork)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/andydan/laravel-annotation-relations.svg)](https://packagist.org/packages/andydan/laravel-annotation-relations)
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status](https://coveralls.io/repos/github/andydan/LaravelAnnotationRelations/badge.svg?branch=master)](https://coveralls.io/github/andydan/LaravelAnnotationRelations?branch=master)
[![StyleCI](https://styleci.io/repos/82421206/shield?branch=master)](https://styleci.io/repos/82421206)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/andydan/LaravelAnnotationRelations/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/andydan/LaravelAnnotationRelations/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/andydan/laravel-annotation-relations.svg)](https://packagist.org/packages/andydan/laravel-annotation-relations)

Annotation relationships for Laravel 5 (a fork)

## Install

Via Composer

``` bash
$ composer require andydan/laravel-annotation-relations
```
Aftewards, override the original code in vendor/andydan/laravel-anotation-relations/src with latest changes from here.
If anyone else, interested in this package features, want to provide a more professional approach, be free to help. 
Contributors wanted. 

## Usage (check HasMany section)

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

## NEW Feature

Now you can also supply extra parameters for the @HasMany annotation.
The first new parameter is the table alias inside your class.
Naming convention is OK for foreign key ids, but terrible for plurals. You might want to have your relation named in a different fashion than the default. Now you can, provide an alias:

``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasMany Comment commentaries
 */
class Post extends Model
{
    use AnnotationRelationships;
}
```
``` php
$comments = Post::first()->commentaries;
```
Notice the Comment class name without an s after HasMany annotation.
It also accepts a second parameter, the foreign key name through which the child class connects to this class (such as the second parameter in $this->belongsTo implementation). It must be provided inside parentheses. Ex:

``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasMany Comment (id_publication)
 */
class Post extends Model
{
    use AnnotationRelationships;
}
```

And you can mix both notations:

``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasMany Comment commentaries(id_publication)
 */
class Post extends Model
{
    use AnnotationRelationships;
}
```

So far, no plans to implement local key parameter (third argument in $this->belongsTo implementation)). It's a matter of time this feature is added to all other annotations.

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

Or

``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasMany Posts through User
 */
class Town extends Model
{
    use AnnotationRelationships;
}
```
``` php
$posts = Town::first()->posts;
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

Or we can try to guess your owner name

``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphTo
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
 * @MorphMany Comments
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
 * @MorphMany Comments
 */
class Video extends Model
{
    use AnnotationRelationships;
}
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

Or we can try to guess your owner name

``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @MorphToMany Tags
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
 * @MorphToMany Tags
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
 * @MorphedByMany Post
 * @MorphedByMany Video
 */
class Tag extends Model
{
    use AnnotationRelationships;
}
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

You can define multiple relationships on model through comma

``` php
use AndyDan\LaravelAnnotationRelations\AnnotationRelationships;
use Illuminate\Database\Eloquent\Model;

/**
 * @HasMany Hands, Eyes
 */
class Rabbit extends Model
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
