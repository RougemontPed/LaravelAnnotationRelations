<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParsers;

use AndyDan\LaravelAnnotationRelations\AnnotationParams\AnnotationParameters;
use AndyDan\LaravelAnnotationRelations\AnnotationParams\BelongsToAnnotationParameters;
use AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException;

class BelongsToAnnotationParser extends AnnotationParserWithClassParameter
{
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
        return new BelongsToAnnotationParameters(
            $this->getRelationshipClassName(
                $parameters,
                $this->getClassNamespaceName($className)
            )
        );
    }
}
