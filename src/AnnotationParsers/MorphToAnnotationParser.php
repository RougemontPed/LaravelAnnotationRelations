<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParsers;

use AndyDan\LaravelAnnotationRelations\AnnotationParams\AnnotationParameters;
use AndyDan\LaravelAnnotationRelations\AnnotationParams\MorphToAnnotationParameters;
use AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException;

class MorphToAnnotationParser extends AnnotationParser
{
    use OwnerNameGuesser;

    /**
     * Parse class annotation params and return array to pass to relation
     *
     * @param string $parameters
     * @param string $className
     * @return AnnotationParameters
     * @throws BadAnnotationException
     */
    public function handle($parameters, $className)
    {
        return new MorphToAnnotationParameters($parameters ?: $this->guessOwnerName($className));
    }

    /**
     * Validate annotation parameters
     *
     * @param string $parameters
     * @throws BadAnnotationException
     */
    protected function validateParameters($parameters)
    {
        if ($parameters && !$this->isValidClassOrMethodName($parameters)) {
            throw new BadAnnotationException('Annotation params should only contain owner');
        }
    }
}
