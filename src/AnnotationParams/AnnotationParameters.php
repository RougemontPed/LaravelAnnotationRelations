<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParams;

abstract class AnnotationParameters
{
    protected $relatedAlias;

    protected $relatedFK;

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
