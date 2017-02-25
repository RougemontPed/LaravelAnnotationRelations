<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParsers;

use AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException;

abstract class AnnotationParserWithClassAndOwnerParameters extends AnnotationParser
{
    /**
     * Related class
     *
     * @var string
     */
    protected $related;

    /**
     * Owner
     *
     * @var string
     */
    protected $owner;

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
            throw new BadAnnotationException('Annotation params should contain 2 parameters');
        }

        list($this->related, $this->owner) = $params;

        if (!$this->isValidClassOrMethodName($this->related) || !$this->isValidClassOrMethodName($this->owner)) {
            throw new BadAnnotationException('Annotation params should contain 2 parameters');
        }
    }
}