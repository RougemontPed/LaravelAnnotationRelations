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

    public function __construct($relatedClassName, $relatedAlias = null, $relatedFK = null, $localKey = null)
    {
        $this->relatedClassName = $relatedClassName;
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
        return $this->relatedAlias ? $this->relatedAlias : str_singular(lcfirst(class_basename($this->relatedClassName)));
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
            $this->relatedFK,
            $this->localKey,
            $this->getRelationshipMethodName(),
        ];
    }
}
