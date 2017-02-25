<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParsers;

use AndyDan\LaravelAnnotationRelations\AnnotationParams\AnnotationParameters;
use AndyDan\LaravelAnnotationRelations\AnnotationParams\MorphToAnnotationParameters;
use AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException;

class MorphToAnnotationParser extends AnnotationParser
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
        return new MorphToAnnotationParameters($parameters);
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

        if (!$this->isValidClassOrMethodName($parameters)) {
            throw new BadAnnotationException('Annotation params should only contain owner');
        }
    }
}
