<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParams;

abstract class AnnotationParameters
{
    /**
     * Return relationship method name
     *
     * @return string
     */
    abstract public function getRelationshipMethodName();

    /**
     * Return relationship method parameters
     *
     * @return array
     */
    abstract public function getRelationshipMethodParameters();
}
