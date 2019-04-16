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
        $modelName = $parameters;
        $relatedAlias = '';
        $relatedFK = '';

        $parameters_array = explode(' ', $parameters);
        $extraArgsRegex = '/([^(]*)?([(]([^)]+)[)])?/';
        if(count($parameters_array) > 1) {
            $modelName = $parameters_array[0];
            preg_match($extraArgsRegex, $parameters_array[1], $extraArgs);
            $relatedAlias = $extraArgs[1];
            $relatedFK = count($extraArgs) == 4 ? $extraArgs[3] : '';
        }
        return new HasManyAnnotationParameters(
            $this->getRelationshipClassName(
                $modelName,
                $this->getClassNamespaceName($className)
            ),
            $relatedAlias,
            $relatedFK
        );
    }
}
