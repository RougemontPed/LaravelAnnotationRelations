<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParsers;

use AndyDan\LaravelAnnotationRelations\AnnotationParams\AnnotationParameters;
use AndyDan\LaravelAnnotationRelations\AnnotationParams\HasOneAnnotationParameters;
use AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException;

class HasOneAnnotationParser extends AnnotationParserWithClassParameter
{
    /**
     * Parse class annotation params and return array to pass to relation
     *
     * @param string $parameters
     * @param string $namespace
     * @return AnnotationParameters
     * @throws BadAnnotationException
     */
    public function handle($parameters, $namespace)
    {
        return new HasOneAnnotationParameters($this->getRelationshipClassName($parameters, $namespace));
    }
}
