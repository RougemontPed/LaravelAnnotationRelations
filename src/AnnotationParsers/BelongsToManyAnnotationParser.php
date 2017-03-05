<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParsers;

use AndyDan\LaravelAnnotationRelations\AnnotationParams\BelongsToManyAnnotationParameters;
use AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException;

class BelongsToManyAnnotationParser extends AnnotationParserWithClassParameter
{
    /**
     * Parse class annotation params and return array to pass to relation
     *
     * @param string $parameters
     * @param string $className
     * @return BelongsToManyAnnotationParameters
     * @throws BadAnnotationException
     */
    public function handle($parameters, $className)
    {
        return new BelongsToManyAnnotationParameters(
            $this->getRelationshipClassName(
                $parameters,
                $this->getClassNamespaceName($className)
            )
        );
    }
}
