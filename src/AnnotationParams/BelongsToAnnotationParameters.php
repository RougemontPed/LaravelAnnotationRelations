<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParams;

class BelongsToAnnotationParameters extends AnnotationParameters
{
    /**
     * Related class name
     *
     * @var string
     */
    protected $relatedClassName;

    public function __construct($relatedClassName)
    {
        $this->relatedClassName = $relatedClassName;
    }

    /**
     * Return relationship method name
     *
     * @return string
     */
    public function getRelationshipMethodName()
    {
        return str_singular(lcfirst(class_basename($this->relatedClassName)));
    }

    /**
     * Return relationship method parameters
     *
     * @return array
     */
    public function getRelationshipMethodParameters()
    {
        return [
            $this->relatedClassName,
            null,
            null,
            $this->getRelationshipMethodName(),
        ];
    }
}
