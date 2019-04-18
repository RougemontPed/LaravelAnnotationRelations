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

        $parameters_array = explode(' ', $parameters);
        
        if (count($parameters_array) > 2) {
            throw new BadAnnotationException('Annotation parameter count exceeded.');
        }

        if (count($parameters_array) === 2) {
            if (!$this->isValidClassOrMethodName($parameters_array[0])
               || !$this->isValidAliasOrFKOrBoth($parameters_array[1])) {
                throw new BadAnnotationException('Annotation parameters declaration expects first '.
                    'argument to be related class name and second argument to be either class alias or foreign_key '.
                    'inside parenthesis or both, with no spaces.');
            }
        } else if (!$this->isValidClassOrMethodName($parameters)) {
            throw new BadAnnotationException('Annotation parameters followed by a String should only contain related class name');
        }
    }
}
