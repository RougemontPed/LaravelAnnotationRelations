<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParsers;

use AndyDan\LaravelAnnotationRelations\AnnotationParams\AnnotationParameters;
use AndyDan\LaravelAnnotationRelations\AnnotationParams\MorphManyAnnotationParameters;
use AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException;

class MorphManyAnnotationParser extends AnnotationParserWithClassAndOwnerParameters
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
        return new MorphManyAnnotationParameters(
            $this->getRelationshipClassName($this->related, $namespace),
            $this->owner
        );
    }
}
