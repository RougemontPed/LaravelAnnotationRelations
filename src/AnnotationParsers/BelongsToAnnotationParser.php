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
        list($modelName, $relatedAlias, $relatedFK, $localKey) = $this->handleExtraParameters($parameters);
        return new BelongsToAnnotationParameters(
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
