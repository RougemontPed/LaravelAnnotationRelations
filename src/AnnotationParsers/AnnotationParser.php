<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParsers;

use AndyDan\LaravelAnnotationRelations\AnnotationParams\AnnotationParameters;
use AndyDan\LaravelAnnotationRelations\Exceptions\BadAnnotationException;
use ReflectionClass;

abstract class AnnotationParser
{
    /**
     * Handle parsing
     *
     * @param string $parameters
     * @param string $className
     * @return AnnotationParameters
     */
    abstract protected function handle($parameters, $className);

    /**
     * Validate annotation parameters
     *
     * @param string $parameters
     * @throws BadAnnotationException
     */
    abstract protected function validateParameters($parameters);

    /**
     * Parse class annotation params and return array to pass to relation
     *
     * @param string $parameters
     * @param string $className
     * @return AnnotationParameters
     */
    public function parse($parameters, $className)
    {
        $this->validateParameters($parameters);

        return $this->handle($parameters, $className);
    }

    /**
     * Class namespace name
     *
     * @param string $className
     * @return string
     */
    protected function getClassNamespaceName($className)
    {
        return (new ReflectionClass($className))->getNamespaceName();
    }

    /**
     * Return full related class name
     *
     * @param string $relationship
     * @param string $namespace
     * @return string
     * @throws BadAnnotationException
     */
    protected function getRelationshipClassName($relationship, $namespace)
    {
        foreach ([str_singular($relationship), $relationship] as $relationshipClassName) {
            if (class_exists($relationshipClassName)) {
                return $relationshipClassName;
            } elseif (class_exists($namespace . '\\' . $relationshipClassName)) {
                return $namespace . '\\' . $relationshipClassName;
            }
        }

        throw new BadAnnotationException("Annotation can't found relation class {$relationship}");
    }

    /**
     * Is class name valid?
     *
     * @param $className
     * @return bool
     */
    protected function isValidClassOrMethodName($className)
    {
        return preg_match('/^[a-zA-Z_\x7f-\xff\\\][a-zA-Z0-9_\x7f-\xff\\\]*$/', $className);
    }
}
