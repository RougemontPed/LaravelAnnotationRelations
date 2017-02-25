<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParams;

class MorphManyAnnotationParameters extends AnnotationParameters
{
    /**
     * Related class name
     *
     * @var string
     */
    protected $relatedClassName;

    /**
     * Owner
     *
     * @var string
     */
    protected $owner;

    public function __construct($relatedClassName, $owner)
    {
        $this->relatedClassName = $relatedClassName;
        $this->owner = $owner;
    }

    /**
     * Return relationship method name
     *
     * @return string
     */
    public function getRelationshipMethodName()
    {
        return str_plural(lcfirst(class_basename($this->relatedClassName)));
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
            $this->owner,
        ];
    }
}
