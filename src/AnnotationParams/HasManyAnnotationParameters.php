<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParams;

class HasManyAnnotationParameters extends AnnotationParameters
{
    /**
     * Related class name
     *
     * @var string
     */
    protected $related;

    public function __construct($relatedClassName)
    {
        $this->related = $relatedClassName;
    }

    /**
     * Return relationship method name
     *
     * @return string
     */
    public function getRelationshipMethodName()
    {
        return str_plural(lcfirst(class_basename($this->related)));
    }

    /**
     * Return relationship method parameters
     *
     * @return array
     */
    public function getRelationshipMethodParameters()
    {
        return [
            $this->related,
        ];
    }
}
