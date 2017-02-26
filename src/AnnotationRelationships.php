<?php

namespace AndyDan\LaravelAnnotationRelations;

use AndyDan\LaravelAnnotationRelations\AnnotationParams\AnnotationParameters;
use DocBlockReader\Reader;
use ReflectionClass;

trait AnnotationRelationships
{
    /**
     * Annotation names which we process
     *
     * @var array
     */
    protected $annotationRelationshipNames = [
        'HasOne',
        'BelongsTo',
        'HasMany',
        'BelongsToMany',
        'HasManyThrough',
        'MorphTo',
        'MorphMany',
        'MorphToMany',
        'MorphedByMany',
    ];

    protected $annotationRelationships;

    /**
     * Parse class annotations
     *
     * @param bool $force If true parse class annotations even if it's already parsed
     */
    protected function parseClassAnnotations($force = false)
    {
        if ($this->annotationRelationships && !$force) {
            return;
        }

        $reader = new Reader(static::class);

        foreach ($reader->getParameters() as $annotationName => $parameters) {
            if (in_array($annotationName, $this->annotationRelationshipNames)) {
                $parameters = is_array($parameters) ? $parameters : [$parameters];

                $this->annotationRelationships[$annotationName] = array_flatten(array_map(
                    function ($params) use ($annotationName) {
                        return $this->parseAnnotationParameters($annotationName, $params);
                    },
                    $parameters
                ));
            }
        }
    }

    /**
     * Parse annotation parameters
     *
     * @param string $annotation
     * @param string $parameters
     * @return AnnotationParameters
     */
    protected function parseAnnotationParameters($annotation, $parameters)
    {
        $parserName = __NAMESPACE__ . "\\AnnotationParsers\\{$annotation}AnnotationParser";

        $parameters = $parameters !== true ? $parameters : '';

        return array_map(function ($params) use ($parserName) {
            return (new $parserName)->parse(trim($params), $this->getCurrentClassNamespaceName());
        }, explode(',', $parameters));
    }

    /**
     * Current class namespace
     *
     * @return string
     */
    protected function getCurrentClassNamespaceName()
    {
        return (new ReflectionClass(static::class))->getNamespaceName();
    }

    public function __get($name)
    {
        $this->parseClassAnnotations();

        foreach ($this->annotationRelationships as $annotation => $relationships) {
            foreach ($relationships as $parameters) {
                if ($name === $parameters->getRelationshipMethodName()) {
                    // If the key already exists in the relationships array, it just means the
                    // relationship has already been loaded, so we'll just return it out of
                    // here because there is no need to query within the relations twice.
                    if ($this->relationLoaded($name)) {
                        return $this->relations[$name];
                    }

                    return $this->getRelationshipFromMethod($name);
                }
            }
        }

        return parent::__get($name);
    }

    public function __call($name, $arguments)
    {
        $this->parseClassAnnotations();

        if (empty($arguments)) {
            foreach ($this->annotationRelationships as $annotation => $relationships) {
                foreach ($relationships as $parameters) {
                    if ($name === $parameters->getRelationshipMethodName()) {
                        $relationshipMethodName = lcfirst($annotation);

                        return call_user_func_array(
                            [$this, $relationshipMethodName],
                            $parameters->getRelationshipMethodParameters()
                        );
                    }
                }
            }
        }

        return parent::__call($name, $arguments);
    }
}
