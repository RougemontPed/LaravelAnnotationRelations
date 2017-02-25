<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParsers;

use AndyDan\LaravelAnnotationRelations\AnnotationParams\HasManyThroughAnnotationParameters;
use AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException;

class HasManyThroughAnnotationParser extends AnnotationParser
{
    /**
     * Related class name
     *
     * @var string
     */
    protected $related;

    /**
     * Through class name
     *
     * @var string
     */
    protected $through;

    /**
     * Parse class annotation params and return array to pass to relation
     *
     * @param string $parameters
     * @param string $namespace
     * @return HasManyThroughAnnotationParameters
     * @throws BadAnnotationException
     */
    public function handle($parameters, $namespace)
    {
        return new HasManyThroughAnnotationParameters(
            $this->getRelationshipClassName($this->related, $namespace),
            $this->getRelationshipClassName($this->through, $namespace)
        );
    }

    /**
     * Validate annotation parameters
     *
     * @param string $parameters
     * @throws BadAnnotationException
     */
    protected function validateParameters($parameters)
    {
        if (!$parameters) {
            throw new BadAnnotationException('Annotation should\'nt be empty');
        }

        $params = explode(' ', $parameters);

        if (count($params) !== 2) {
            throw new BadAnnotationException('Annotation params should only contain 2 related class names');
        }

        list($this->related, $this->through) = $params;

        if (!$this->isValidClassOrMethodName($this->related) || !$this->isValidClassOrMethodName($this->through)) {
            throw new BadAnnotationException('Annotation params should only contain 2 related class names');
        }
    }
}
