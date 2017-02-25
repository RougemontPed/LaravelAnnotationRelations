<?php

namespace AndyDan\LaravelAnnotationRelations\AnnotationParams;

class MorphToAnnotationParameters extends AnnotationParameters
{
    /**
     * Owner
     *
     * @var string
     */
    protected $owner;

    public function __construct($owner)
    {
        $this->owner = $owner;
    }

    /**
     * Return relationship method name
     *
     * @return string
     */
    public function getRelationshipMethodName()
    {
        return $this->owner;
    }

    /**
     * Return relationship method parameters
     *
     * @return array
     */
    public function getRelationshipMethodParameters()
    {
        return [
            $this->owner,
        ];
    }
}
