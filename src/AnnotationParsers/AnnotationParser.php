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

        throw new BadAnnotationException("Annotation can't find relation class {$relationship}");
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

    /**
     * $argument must be in one of five formats:
     * > alias
     * > (fk_name)
     * > (fk_name->local_key)
     * > alias(fk_name)
     * > alias(fk_name->local_key)
     * @param $argument
     * @return bool
     */
    protected function isValidAliasOrFKOrBoth($argument)  {
        $varName = '[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*';
        return preg_match('/^('.$varName
                          .'|[(]'.$varName.'[)]'
                          .'|[(]'.$varName.'[-][>]'.$varName.'[)]'
                          .'|'.$varName.'[(]'.$varName.'[)]'
                          .'|'.$varName.'[(]'.$varName.'[-][>]'.$varName.'[)])$/', $argument);
    }

    /**
     * Undocumented function
     * @param [type] $parameters
     * @return void
     */
    protected function handleExtraParameters($parameters) {
        $modelName = $parameters;
        $relatedAlias = null;
        $relatedFK = null;
        $localKey = null;

        $parameters_array = explode(' ', $parameters);
        $extraArgsRegex = '/([^(]*)?([(]([^)]+)[)])?/';

        if (count($parameters_array) > 1) {
            $modelName = $parameters_array[0];
            preg_match($extraArgsRegex, $parameters_array[1], $extraArgs);
            $relatedAlias = $extraArgs[1];
            if (count($extraArgs) == 4) {
                if (!strstr($extraArgs[3],  '->')) {
                    $relatedFK = $extraArgs[3];
                } else {
                    $extraArgsArray = explode('->', $extraArgs[3]);
                    $relatedFK = trim($extraArgsArray[0]);
                    $localKey = trim($extraArgsArray[1]);
                }
            }
        }
        
        return array($modelName, $relatedAlias, $relatedFK, $localKey);
    }
}
