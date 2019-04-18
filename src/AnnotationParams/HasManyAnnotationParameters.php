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

    public function __construct($relatedClassName, $relatedAlias = '', $relatedFK = '', $localKey = '')
    {
        $this->related = $relatedClassName;
        $this->relatedAlias = $relatedAlias;
        $this->relatedFK = $relatedFK;
        $this->localKey = $localKey;
    }

    /**
     * Return relationship method name
     *
     * @return string
     */
    public function getRelationshipMethodName()
    {
        return ($this->relatedAlias != '') ? $this->relatedAlias : str_plural(lcfirst(class_basename($this->related)));
    }

    /**
     * Return relationship method parameters
     *
     * @return array
     */
    public function getRelationshipMethodParameters()
    {
        return [$this->related,
                $this->relatedFK,
                $this->localKey == '' ? 'id' : $this->localKey];
    }
}
