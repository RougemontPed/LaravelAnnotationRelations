<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParsers;

use AndyDan\LaravelAnnotationRelations\AnnotationParams\HasManyAnnotationParameters;
use AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException;

class HasManyAnnotationParser extends AnnotationParserWithClassParameter
{
    /**
     * Parse class annotation params and return array to pass to relation
     *
     * @param string $parameters
     * @param string $className
     * @return HasManyAnnotationParameters
     * @throws BadAnnotationException
     */
    public function handle($parameters, $className)
    {
        list($modelName, $relatedAlias, $relatedFK, $localKey) = $this->handleExtraParameters($parameters);
        return new HasManyAnnotationParameters(
            $this->getRelationshipClassName(
                $modelName,
                $this->getClassNamespaceName($className)
            ),
            $relatedAlias,
            $relatedFK,
            $localKey
        );
    }
}
