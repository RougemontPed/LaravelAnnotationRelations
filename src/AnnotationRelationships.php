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

        $annotationParameters = $this->prepareAnnotationParameters($reader->getParameters());
            
        foreach ($annotationParameters as $annotationName => $parameters) {
            if (in_array($annotationName, $this->annotationRelationshipNames)) {
                $parameters = (array) $parameters;

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
     * Prepare annotation parameters for processing
     * Change @HasMany Classes through Class -> @HasManyThrough Classes Class
     *
     * @param array $parameters
     * @return array
     */
    protected function prepareAnnotationParameters($parameters)
    {
        if (isset($parameters['HasMany'])) {
            $parameters['HasMany'] = (array) $parameters['HasMany'];

            foreach ($parameters['HasMany'] as $i => $params) {
                if ($this->isComplexHasManyThroughAnnotationParameters($params)) {
                    $parameters['HasManyThrough'] = isset($parameters['HasManyThrough']) ?
                        (array) $parameters['HasManyThrough'] : [];

                    $parameters['HasManyThrough'][] = $this->parseComplexHasManyThroughAnnotationParameters($params);

                    unset($parameters['HasMany'][$i]);
                }
            }
        }

        return $parameters;
    }

    /**
     * Return true if annotation looks like @HasMany Classes through Class
     *
     * @param string $parameters
     * @return bool
     */
    protected function isComplexHasManyThroughAnnotationParameters($parameters)
    {
        $parameters = explode(' ', $parameters);

        return count($parameters) === 3 && $parameters[1] === 'through';
    }

    /**
     * Parse parameters @HasMany Classes through Class
     * Return @HasManyThrough Classes Class
     *
     * @param string $parameters
     * @return string
     */
    protected function parseComplexHasManyThroughAnnotationParameters($parameters)
    {
        $parameters = explode(' ', $parameters);

        return "{$parameters[0]} {$parameters[2]}";
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
            return (new $parserName)->parse(trim($params), static::class);
        }, explode(',', $parameters));
    }

    public function __get($name)
    {
        $this->parseClassAnnotations();
        
        if ($this->annotationRelationships) {
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
