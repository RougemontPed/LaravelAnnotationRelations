<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParsers;

use AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException;

abstract class AnnotationParserWithClassParameter extends AnnotationParser
{
    /**
     * Validate annotation parameters
     *
     * @param string $parameters
     * @throws BadAnnotationException
     */
    protected function validateParameters($parameters)
    {
        if (!$parameters) {
            throw new BadAnnotationException('Annotation definition should\'nt be empty');
        }

        if (!$this->isValidClassOrMethodName($parameters)) {
            throw new BadAnnotationException('Annotation parameters should only contain related class name');
        }
    }
}
